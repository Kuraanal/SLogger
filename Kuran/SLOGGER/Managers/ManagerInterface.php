<?php
namespace Kuran\SLogger\Managers;

use Kuran\SLogger\Formaters\FormaterInterface;
use Kuran\SLogger\ErrorLevel;

interface ManagerInterface{
    public function execute($level, $message, $context): bool;
    public function setFormater(array $formater);
    public function canManage(ErrorLevel $level): bool;
}

?>