<?php
namespace Kuran\SLogger\Formaters;

use Kuran\SLogger\ErrorLevel;

interface FormaterInterface{

    public function format(ErrorLevel $level, string $message, array $context): string;
    public function interpolate(string $message, array $context = array()): string;
    
}

?>