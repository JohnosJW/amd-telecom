<?php

declare(strict_types=1);

namespace App\Contracts;

/**
 * The MessageSenderInterface
 */
interface MessageSenderInterface
{
    /**
     * The method sends a message like sms, email, etc.
     *
     * @param string $accessToken
     * @param string $message
     * @param string $to
     * @param string $from
     * @return bool
     */
    public function send(string $accessToken, string $message, string $to, string $from): bool;
}