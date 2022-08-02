# Task Trial PHP

## Installation

Rename .env.example file to .env and change DB access details.

Create a mysql database and update the database name in the .env file

php artisan migrate

php artisan db:seed


## Running API

php -S localhost:8000 -t public

## Run API tests

./vendor/bin/phpunit
