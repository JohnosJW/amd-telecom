<?php

declare(strict_types=1);

namespace App\Implementations;

use App\Contracts\MessageSenderInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

/**
 * The class for working with sms sending
 */
class SmsMessageSender implements MessageSenderInterface
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
     * The method sends a sms message
     *
     * @param string $accessToken
     * @param string $message
     * @param string $to
     * @param string $from
     * @return bool
     * @throws GuzzleException
     */
    public function send(string $accessToken, string $message, string $to, string $from): bool
    {
        try {
             $this->httpClient->request('POST', 'https://connect.routee.net/sms', [
                'headers' => [
                    'authorization' => 'Bearer ' . $accessToken,
                    'content-type' => 'application/json'
                ],
                'json' => [
                    'body' => $message,
                    'to' => $to,
                    'from' => $from
                ]
            ]);

            return true;
        } catch (RuntimeException $e) {
            throw new RuntimeException($e->getMessage());
        }
    }
}