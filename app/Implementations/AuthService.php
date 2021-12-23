<?php

declare(strict_types=1);

namespace App\Implementations;

use App\Contracts\AuthServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

/**
 * The class authorizes in the Routee API
 */
class AuthService implements AuthServiceInterface
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
     * The method returns authorized token
     *
     * @return string|null
     * @throws GuzzleException
     */
    public function getAuthToken(): ?string
    {
        try {
            $res = $this->httpClient->request('POST', 'https://auth.routee.net/oauth/token', [
                'headers' => [
                    'authorization' => 'Basic ' . getenv('AUTH_TOKEN'),
                    'content-type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials'
                ]
            ]);

            if (200 !== $res->getStatusCode()) {
                throw new RuntimeException();
            }

            $resBody = $res->getBody();
            $resContents = json_decode($resBody->getContents(), true);

            return $resContents['access_token'];
        } catch (RuntimeException $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
}