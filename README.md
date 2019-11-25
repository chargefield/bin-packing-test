# Bin Packing Test

A test project using Laravel for packing a set number of orders with products of different sizes.

## The Problem

Create an algorithm to take incoming orders and populate printing sheets.

-   Sheets can be considered as a 10 unit by 15 unit grid
-   Products come in sizes [ 1x1, 2x2, 3x3, 4x4, 5x2, 2x5 ]
-   1x1 -> means 1 grid unit by 1 grid unit

### Constraints

-   Must use Laravel and Eloquent to develop algorithm
-   Orders must have all of their items on the same print sheet
-   Orders can have any number of items with any number of quantity
-   Must be able to track placement of products on the sheets
-   Generate 50 sheets with test data
-   Bonus: Solutions that present the least amount of wasted space on sheets

## Installation

Fork or download this repository:

```
git@github.com:chargefield/bin-packing-test.git
```

In the terminal, `cd` into the directory and use composer to install the default Laravel packages:

```bash
composer install
```

_Note: You might need to duplicate the `.env.example` file and name it `.env`. Fill out any important values to get the app up and running._

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
php artisan migrate:fresh --seed
```

This will seed the database with (50) orders with a random number of products. You can keep running this command to see different results.

_Note: You can change the number of orders created in the `database/seeds/OrdersTableSeeder.php` file._

### Preview

You can use `php artisan serve` or whatever local web server you have to serve local websites. You will find a visual preview of the data generated.

**Example:**

![Screenshot](https://github.com/chargefield/bin-packing-test/blob/master/screenshot.png?raw=true)

## Todos

This isn't the perfect/only solution.

There are a bunch of improvements left to do:

-   multiple sheets for overflow items
-   fill sheets with multiple orders if there is room
