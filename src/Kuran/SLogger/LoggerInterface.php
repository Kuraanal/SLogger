<?php

namespace Kuran\SLogger;

interface LoggerInterface
{
    
    /**
     * Sets the logger managers.
     *
     * @param array $managers An array of manager instances to be set.
     *
     * @return void
     */
    public function setManagers(array $managers): void;

    /**
     * Adds a manager to the logger.
     *
     * @param Managers\ManagerInterface $manager The manager instance to add.
     *
     * @return void
     */
    public function addManager(Managers\ManagerInterface $manager): void;

    /**
     * Logs an emergency message indicating the system is unusable.
     *
     * @param string|\Stringable $message The log message.
     * @param array $context Optional context array with additional information.
     */
    public function emergency(string|\Stringable $message, array $context = []): void;
    
    /**
     * Logs an alert message indicating immediate action is required.
     *
     * @param string|\Stringable $message The log message.
     * @param array $context Optional context array with additional information.
     */
    public function alert(string|\Stringable $message, array $context = []): void;

    /**
     * Logs a critical message indicating critical conditions.
     *
     * @param string|\Stringable $message The log message.
     * @param array $context Optional context array with additional information.
     */
    public function critical(string|\Stringable $message, array $context = []): void;

    /**
     * Logs an error message indicating runtime errors that do not require immediate action.
     *
     * @param string|\Stringable $message The log message.
     * @param array $context Optional context array with additional information.
     */
    public function error(string|\Stringable $message, array $context = []): void;

    /**
     * Logs a warning message indicating exceptional occurrences that are not errors.
     *
     * @param string|\Stringable $message The log message.
     * @param array $context Optional context array with additional information.
     */
    public function warning(string|\Stringable $message, array $context = []): void;

    /**
     * Logs a notice message indicating normal but significant events.
     *
     * @param string|\Stringable $message The log message.
     * @param array $context Optional context array with additional information.
     */
    public function notice(string|\Stringable $message, array $context = []): void;

    /**
     * Logs an informational message indicating interesting events.
     *
     * @param string|\Stringable $message The log message.
     * @param array $context Optional context array with additional information.
     */
    public function info(string|\Stringable $message, array $context = []): void;

    /**
     * Logs a debug message for debugging purposes.
     *
     * @param string|\Stringable $message The log message.
     * @param array $context Optional context array with additional information.
     */
    public function debug(string|\Stringable $message, array $context = []): void;

    /**
     * Logs a message with a specified error level.
     *
     * @param ErrorLevel $level The severity level of the log.
     * @param string|\Stringable $message The log message.
     * @param array $context Optional context array with additional information.
     */
    public function log(ErrorLevel $level, string|\Stringable $message, array $context = []): void;
}
