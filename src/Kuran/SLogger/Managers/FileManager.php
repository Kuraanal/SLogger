<?php
namespace Kuran\SLogger\Managers;

use Kuran\SLogger\Managers\ManagerInterface;
use Kuran\SLogger\Formaters\{FormaterInterface, LineFormater};
use Kuran\SLogger\ErrorLevel;

class FileManager implements ManagerInterface{

    private FormaterInterface $formater;

    private string $filePath;

    private ErrorLevel $errorLevel;

    public function __construct(
        string $filePath = 'app.log',
        ErrorLevel $level = ErrorLevel::ERROR,
        FormaterInterface|null $formater = null)
    {
        $this->formater = $formater === null ? new LineFormater() : $formater;
        $this->filePath = $filePath;
        $this->errorLevel = $level;
    }

    public function execute(
        ErrorLevel $level,
        string $message,
        array $context): bool
    {

        if (!is_dir(pathinfo($this->filePath, PATHINFO_DIRNAME))) {
            if (!mkdir(pathinfo($this->filePath, PATHINFO_DIRNAME), 0777, true)) {
                $error_message = "Cannot create directory for file '$this->filePath'";
                error_log($error_message);
                return false;
            }
        }

        $formattedMessage = $this->formater->format($level, $message, $context);

        $bytes_written = file_put_contents($this->filePath, $formattedMessage, FILE_APPEND | LOCK_EX);

        // Check if the write was successful
        if ($bytes_written === false)
        {
            $error_message = "Cannot write to file '$this->filePath': General error";
            error_log($error_message);
            return false;
        }

        // Check if the message was partially written
        if ($bytes_written < strlen($message))
        {
            $error_message = "Cannot write to file '$this->filePath': Partial write";
            error_log($error_message);
            return false;
        }

        return true;
    }

    public function setFormater(FormaterInterface $formater)
    {
        $this->formater = $formater;
    }

    public function canManage(ErrorLevel $level): bool{
        return $this->errorLevel->value <= $level->value;
    }
}

?>