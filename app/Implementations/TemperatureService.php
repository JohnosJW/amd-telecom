<?php

declare(strict_types=1);

namespace App\Implementations;

use App\Contracts\TemperatureServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

/**
 * The class for working with weather API
 */
class TemperatureService implements TemperatureServiceInterface
{
    /**
     * @var Client
     */
    private $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client(['verify' => false]);
    }

    /**
     * The method returns actual temperature by city
     *
     * @param string $city
     * @return float|null
     * @throws GuzzleException
     */
    public function getActualTemperatureByCity(string $city): ?float
    {
        try {
            $res = $this->httpClient->get(
                'https://api.openweathermap.org/data/2.5/weather',
                [
                'query' => [
                    'appid' => getenv('API_KEY'),
                    'q' => $city,
                    'units' => 'metric'
                ]
            ]);

            if (200 !== $res->getStatusCode()) {
                throw new RuntimeException();
            }

            $body = $res->getBody();
            $contents = json_decode($body->getContents(), true);

            return $contents['main']['temp'];
        } catch (RuntimeException $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
}