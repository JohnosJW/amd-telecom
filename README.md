## Install project
Run command: `docker-compose up -d --build`

Run `docker exec -it test-php bash` and after inside CLI command to run script: `composer install`

Copy config file `cp .env.example .env`

## SMS sender

To run script you must install PHP version not less than 7.2.

Run `docker exec -it test-php bash` and after inside CLI command to run script:

    php public/index.php

## The project has the unit tests
Run `./vendor/bin/phpunit --testdox tests`