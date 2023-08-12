<?php
namespace Kuran\SLogger;

/**
 * S-LOGGER CLASS
 * 
 * This class is a simple logger class to log messages to files or database.
 * It should be PSR-3 Compliant.
 * 
 * This class need php 8.1 as it is using enums for the Error Level definitions.
 *
 * @author AGNEL Eric <eric.agnel@gmail.com>
 *
 * @version 0.9
 */

use Kuran\SLogger\ErrorLevel;
use Kuran\SLogger\Managers\ManagerInterface;
use \Exception;
use Psr\Log\LoggerInterface;

class Logger implements LoggerInterface
{

    private array $managers;

    public function __construct(array $managers = array()){
        $this->managers = count($managers) === 0 ? array() : $managers;
    }

    public function setManagers(array $managers){
        $this->managers = $managers;
    }

    public function addManager(ManagerInterface $manager){
        $this->managers[] = $manager;
    }

    public function log($level, $message, array $context = array()): void{
        foreach($this->managers as $manager){
            if($manager->canManage($level))
                $manager->execute($level, $message, $context);
        }
    }

    public function emergency($message, array $context = array()): void{
        $this->log(ErrorLevel::EMERGENCY, $message, $context);
    }

    public function alert($message, array $context = array()): void{
        $this->log(ErrorLevel::ALERT, $message, $context);
    }

    public function critical($message, array $context = array()): void{
        $this->log(ErrorLevel::CRITICAL, $message, $context);
    }

    public function error($message, array $context = array()): void{
        $this->log(ErrorLevel::ERROR, $message, $context);
    }

    public function warning($message, array $context = array()): void{
        $this->log(ErrorLevel::WARNING, $message, $context);
    }

    public function notice($message, array $context = array()): void{
        $this->log(ErrorLevel::NOTICE, $message, $context);
    }

    public function info($message, array $context = array()): void{
        $this->log(ErrorLevel::INFO, $message, $context);
    }

    public function debug($message, array $context = array()): void{
        $this->log(ErrorLevel::DEBUG, $message, $context);
    }
}

?>