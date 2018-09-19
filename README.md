# File upload example

## Setup
    $ composer install
    $ yarn install

Copy the example .env file:

    $ cp .env.example .env

And don't forget to update the following parameters:

    # Database details
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=dbname
    DB_USERNAME=user
    DB_PASSWORD=pass
    
    # Change from sync to database
    QUEUE_CONNECTION=database

Then run the migrations to setup the database.

    $ php artisan migrate
   
Also, make sure you update the app key:
   
    $ php artisan key:generate
   
## Run tests
    $ vendor/bin/phpunit
    
## Process job queue
    $ php artisan queue:work