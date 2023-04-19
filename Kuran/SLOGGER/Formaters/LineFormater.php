<?php
namespace Kuran\SLogger\Formaters;

use Kuran\SLogger\ErrorLevel;
use Kuran\SLogger\Formaters\FormaterInterface;

class LineFormater implements FormaterInterface
{

    private const DEFAULT_STRING_FORMAT = "{:date} [{:errorLevel}] > {:message} (Context: {:context})\n";
    private const DEFAULT_TIME_FORMAT = "Y-m-d H:i:s";

    private string $messageFormat;
    private string $timeFormat;

    public function __construct(string $format = null, string $timeFormat = null)
    {
        $this->messageFormat = $format === null ? static::DEFAULT_STRING_FORMAT : $format;
        $this->timeFormat = $timeFormat === null ? static::DEFAULT_TIME_FORMAT : $timeFormat;
    }

    public function format(ErrorLevel $level, string $message, array $context): string
    {
        $decripted = $this->interpolate($message, $context);

        return $this->interpolate($this->messageFormat, array(
            ":date" => date($this->timeFormat),
            ":errorLevel" => $level->name,
            ":message" => $decripted,
            ":context" => json_encode($context),
        ));
    }

    public function interpolate(string $message, array $context = array()): string
    {
        $replace = array();
        foreach ($context as $key => $val) {
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }

        return strtr($message, $replace);
    }
}
