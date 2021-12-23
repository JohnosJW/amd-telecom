<?php

declare(strict_types=1);

namespace App\Factory;

/**
 * The class returns special messages by criteria
 */
class MessageFactory
{
    const DEFAULT_TEMPERATURE = 20;

    /**
     * The method returns message whose depends on from city and temperature
     *
     * @param float $actualTemperature
     * @param string $city
     * @param int $temperature
     * @return string
     */
    public static function getMessageByTemperature(
        float $actualTemperature, string $city, int $temperature = self::DEFAULT_TEMPERATURE
    ): string
    {
        return $actualTemperature > $temperature
            ? $city . ': Temperature more than ' . $temperature . 'C. Actual: ' . $actualTemperature
            : $city . ': Temperature less than ' . $temperature . 'C. Actual: ' . $actualTemperature;
    }
}