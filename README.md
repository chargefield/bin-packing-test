# Bin Packing Test

A test Laravel project for packing a random number of orders of products of different sizes.

## Installation

Fork or download this repository:

```
git@github.com:chargefield/bin-packing-test.git
```

In the terminal, cd into the directory and run composer to install the default laravel packages:

```bash
composer install
```

_Note: You might have to copy `.env.example` file and name it to `.env`. Fill out any important values to get the app running._

### Database Setup

Create a database and update the `.env` file with the correct values.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=secret
```

## Usage

### Seed Database

```bash
php artisan migrate --seed
```

This will seed the database with 50 orders of random number of products.

_Note: You can change the number of orders created or the number of products created in the `database/seeds/OrdersTableSeeder.php` file._

### Preview

You can use `php artisan serve` or whatever local web server you have to server the website. You will find a visual preview of the data generated.

![Screenshot](https://github.com/chargefield/bin-packing-test/blob/master/screenshot.png?raw=true)

## Todos

There are a lot of stuff that can be improved:

-   multiple sheets for overflow
-   sheets with multiple orders if there is room
