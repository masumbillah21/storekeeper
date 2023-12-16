# Laravel Storekeeper project

## Login

- Email: `masum@billah.com`
- Password: `12345678`

## Installation

- Run `git clone https://github.com/masumbillah21/storekeeper.git`
- Run `cd storekeeper`
- - Run `composer install`
- Run `npm install`
- Run `cp .env.example .env`
- Create a database
- In .env file add your database login credentials
- Add APP_NAME & APP_URL
- Run `php artisan key:generate`
- Run `php artisan migrate:refresh --seed`
- Run `php artisan serve`
- Go to your site link. (For localhost: http://127.0.0.1:8000/)