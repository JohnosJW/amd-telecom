<?php

declare(strict_types=1);

namespace App\Contracts;

/**
 * The AuthServiceInterface
 */
interface AuthServiceInterface
{
    /**
     * The method returns authorized token
     *
     * @return string|null
     */
    public function getAuthToken(): ?string;
}