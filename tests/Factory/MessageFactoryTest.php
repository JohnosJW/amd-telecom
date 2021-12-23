<?php

declare(strict_types=1);

namespace Factory;

use App\Factory\MessageFactory;
use PHPUnit\Framework\TestCase;

final class MessageFactoryTest extends TestCase
{
    public function testCanGetCorrectMessage(): void
    {
        $actualTemperature = 30;
        $city = 'Thessaloniki';
        $message = MessageFactory::getMessageByTemperature($actualTemperature, $city);

        $this->assertEquals(
            $city . ': Temperature more than 20C. Actual: ' . $actualTemperature,
            $message
        );
    }
}