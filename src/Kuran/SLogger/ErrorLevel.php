<?php

namespace Kuran\SLogger;

use \InvalidArgumentException;

/**
 * ERROR LEVEL Enum class
 * Used to define the error level value
 */
enum ErrorLevel: int
{
    case EMERGENCY = 800;
    case ALERT     = 700;
    case CRITICAL  = 600;
    case ERROR     = 500;
    case WARNING   = 400;
    case NOTICE    = 300;
    case INFO      = 200;
    case DEBUG     = 100;


    /**
     * Create a new instance from the given value.
     *
     * @param int $value The value to create the instance from
     * @throws InvalidArgumentException If the value is not found in the cases
     * @return self The new instance created from the given value
     */
    public static function fromValue(int $value): self
    {
        $values = array_map(fn ($case) => $case->value, self::cases());
        $index = array_search($value, $values, true);
        if ($index === false) {
            throw new InvalidArgumentException("Invalid error level value: $value");
        }

        return self::cases()[$index];
    }

        /**
     * Returns a case object from a given name.
     *
     * @param string $name The name of the case.
     * @throws InvalidArgumentException If the provided name is not found.
     * @return self The case object with the provided name.
     */
    public static function fromName(string $name): self
    {
        $values = array_map(fn ($case) => $case->name, self::cases());
        $index = array_search($name, $values, true);
        if ($index === false) {
            throw new InvalidArgumentException("Invalid error level name: $name");
        }
        
        return self::cases()[$index];
    }
}

?>