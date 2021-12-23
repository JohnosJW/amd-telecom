<?php

declare(strict_types=1);

namespace Implementations;

use App\Contracts\AuthServiceInterface;
use App\Contracts\MessageSenderInterface;
use App\Contracts\TemperatureServiceInterface;
use App\Implementations\AuthService;
use App\Implementations\Container;
use App\Implementations\SmsMessageSender;
use App\Implementations\TemperatureService;
use PHPUnit\Framework\TestCase;

final class ContainerTest extends TestCase
{
    /**
     * @return \Generator
     */
    public function dataProvider(): \Generator
    {
        yield [AuthServiceInterface::class, AuthService::class];
        yield [MessageSenderInterface::class, SmsMessageSender::class];
        yield [TemperatureServiceInterface::class, TemperatureService::class];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testCanBeResolveClass($interface, $model): void
    {
        $object = Container::getContainer()->resolve($interface);
        $this->assertTrue($object instanceof $model);
    }
}