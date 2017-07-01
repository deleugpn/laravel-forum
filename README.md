## Laravel Forum

This package allows you to easily add a simple forum to your application whilst also supporting ease of use and expansion.

## Features

+ Very flexible usage, very easy to expand upon

## Installation

Install the package directly from the command line using the following command.

```bash
composer require "bitporch/laravel-forum"
```

Next open up `config/app.php` and add the following under the package providers section.

```php
Bitporch\Forum\ForumServiceProvider::class,
```

Then go ahead and run our easy to use install command.

```bash
php artisan forum:install
```

## Assets

Run the following command to publish the migrations and config file.

```bash
php artisan vendor:publish --provider="Bitporch\Forum\ForumServiceProvider"
```

## Traits

Next up you'll need to add the `ForumUser` trait to your `User` model.

```php
<?php

namespace App;

use Bitporch\Forum\Traits\ForumUser;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use ForumUser;
}
```

## Migrations
Run the following command to migrate Laravel Forum after publishing the assets.

```bash
php artisan migrate
```

## Configuration

After publishing, the forum config file can be found under `config/forum.php` where you can modify the package configuration.
