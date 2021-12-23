<?php

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__ . '/../');
$dotenv->load();

for ($i = 0; $i < 10; $i++) {
    (new \App\Implementations\App())->run();
    sleep(600);
}