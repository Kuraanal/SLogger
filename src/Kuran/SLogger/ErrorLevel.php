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
     *  Check if a value exist and then return it.
     * 
     * If the value is a case, return the case object.
     * If the value is not a case, throw an exception of type "InvalidArgumentException".
     * 
     * @param int $value => value to be tested.
     * 
     * @return 
     **/
    public static function fromValue(int $value): self
    {
        $values = array_map(fn ($case) => $case->value, self::cases());
        $index = array_search($value, $values, true);
        if ($index === false) {
            throw new InvalidArgumentException("Invalid error level value: $value");
        }
        return self::cases()[$index];
    }
}

?>