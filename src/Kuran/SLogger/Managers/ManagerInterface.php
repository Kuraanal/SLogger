<?php
namespace Kuran\SLogger\Managers;

use Kuran\SLogger\Formaters\FormaterInterface;
use Kuran\SLogger\ErrorLevel;

interface ManagerInterface{
    public function execute(ErrorLevel $level, string $message, array $context): bool;
    public function setFormater(FormaterInterface $formater);
    public function canManage(ErrorLevel $level): bool;
}

?>