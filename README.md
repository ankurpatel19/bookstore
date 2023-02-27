BookStore

Rebuild of the original BookStore repo

Getting Started:
Create .env file - There is an example.env file you can copy paste. This file holds all environment variables

From the root directory (i.e the directory this file is in) open a terminal and enter:

npm install

composer install

We will need to create the Application Key for Laravel. From our terminal window: php artisan key:generate

Migrate database

php artisan migrate

To run a migration and seed the data on a clean database use:

php artisan migrate --seed

To rebuild database from scratch and reseed:

php artisan migrate:refresh --seed

To run the server

php artisan serve

To truncate database and re-seed:

php artisan seed:truncate

JS and CSS Compilation
Javascript, CSS and Vue files are compiled/minified using WebPack. To run WebPack - to build JS and Vue components for Dev or Prod environments npm run dev OR npm run production

To auto build changes made to Vue components and JS npm run watch OR npm run watch-poll
