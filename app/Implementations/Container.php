<?php

declare(strict_types=1);

namespace App\Implementations;

use App\Contracts\AuthServiceInterface;
use App\Contracts\MessageSenderInterface;
use App\Contracts\TemperatureServiceInterface;

class Container
{
    /**
     * @var self
     */
    protected static $container;

    /**
     * @var array
     */
    protected $bindings = [
        TemperatureServiceInterface::class => TemperatureService::class,
        AuthServiceInterface::class => AuthService::class,
        MessageSenderInterface::class => SmsMessageSender::class,
    ];

    /**
     * @var array
     */
    protected $instances = [];

    private function __construct() {
        // Empty constructor just to make it private and avoid instance creation somewhere outside
    }

    /**
     * @return static
     */
    public static function getContainer(): self
    {
        return self::$container = self::$container ?? new Container();
    }

    /**
     * @param string $interface
     * @return mixed
     */
    public function resolve(string $interface)
    {
        if (isset($this->instances[$interface])) {
            return $this->instances[$interface];
        }

        if (!isset($this->bindings[$interface])) {
            throw new \InvalidArgumentException('Invalid object requested.');
        }

        $this->instances[$interface] = new $this->bindings[$interface];

        return $this->instances[$interface];
    }
}