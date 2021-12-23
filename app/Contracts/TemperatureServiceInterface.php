<?php

declare(strict_types=1);

namespace App\Contracts;

/**
 * The TemperatureService interface
 */
interface TemperatureServiceInterface
{
    /**
     * The method returns actual temperature by city
     *
     * @param string $city
     * @return float|null
     */
    public function getActualTemperatureByCity(string $city): ?float;
}