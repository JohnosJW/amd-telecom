<?php

declare(strict_types=1);

namespace App\Implementations;


use App\Contracts\AuthServiceInterface;
use App\Contracts\MessageSenderInterface;
use App\Contracts\TemperatureServiceInterface;
use App\Factory\MessageFactory;

/**
 * The class run send message script
 */
class App
{
    /**
     * @var TemperatureServiceInterface
     */
    private $temperatureService;

    /**
     * @var AuthServiceInterface
     */
    private $authService;

    /**
     * @var MessageSenderInterface
     */
    private $messageSender;

    public function __construct()
    {
        $this->temperatureService = Container::getContainer()->resolve(TemperatureServiceInterface::class);
        $this->authService = Container::getContainer()->resolve(AuthServiceInterface::class);
        $this->messageSender = Container::getContainer()->resolve(MessageSenderInterface::class);
    }

    /**
     * The method can work with sms, email etc. senders from common interface MessageSenderInterface
     *
     * @return bool
     */
    public function run(): bool
    {
        try {
            $city = getenv('CITY');
            $to = getenv('TO');
            $actualTemperature = $this->temperatureService->getActualTemperatureByCity($city);

            $this->messageSender->send(
                $this->authService->getAuthToken(),
                MessageFactory::getMessageByTemperature($actualTemperature, $city),
                $to,
                'Routee'
            );

            return true;
        } catch (\Exception $e) {
            print $e->getMessage();
            return false;
        }
    }
}
