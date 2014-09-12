[ ![Codeship Status for daylerees/anbu](https://www.codeship.io/projects/1657b700-1681-0132-af64-5ae52864a4c1/status?branch=master)](https://www.codeship.io/projects/33889)

![Github Release](http://img.shields.io/github/release/daylerees/anbu.svg?style=flat-square)
![Packagist License](http://img.shields.io/packagist/l/daylerees/anbu.svg?style=flat-square)
![Packagist Downloads](http://img.shields.io/packagist/dt/daylerees/anbu.svg?style=flat-square)
![Github Issues](http://img.shields.io/github/issues/daylerees/anbu.svg?style=flat-square)
[![Tips](http://img.shields.io/gratipay/daylerees.svg?style=flat-square)](https://gratipay.com/daylerees)

# Anbu Profiler for Laravel PHP

![Anbu Profiler](https://raw.githubusercontent.com/daylerees/anbu/master/screenshot.png)

## Notice

This profiler is still **WORK IN PROGRESS**. Don't get me wrong, it works just fine, but don't file issues or PRs yet!

## Installation

You'll need to add the package to the `require` section of your Laravel app `composer.json` file:

    "daylerees/anbu": "dev-master"

First ensure that you have a database, and that it is configured with Laravel.

Next add the following service provider to `app/config/app.php`:

    'Anbu\ProfilerServiceProvider',

Next use the `asset:publish` command for Artisan to publish profiler asset files.

    php artisan asset:publish

Finally, execute a page of your application and click on the Laravel icon in the lower left.

## Timers

If you want to use Anbu timers, you'll need to include the Facade in the `app/config/app.php` file:

    'Anbu' => 'Anbu\Facades\Anbu',

Now you can create timers like this:

    Anbu::timers()->start('test');
    sleep(30); // Do something interesting here.
    Anbu::timers()->end('test', 'Completed doing something.');

## Debug

When you use `dd()` you risk exposing information to the users of your application. Instead, use `ad()` to dump this data into the 'Debug' section of Anbu.

    ad('foo');


## Hide & Disable

First let me explain the two concepts.

To **hide** is to eliminate the Laravel icon button from requests, so that it won't interfere with certain content types.

To **disable** is to stop the profiler from storing the request, and displaying the button. Data for this request will be lost.

You can **hide** the profiler using:

    Anbu::hide();

Or you can apply the `anbu.hide` filter as a `before` filter to any route or route group.

You can **disable** the profiler using:

    Anbu::disable();

Or you can apply the `anbu.disable` filter as a `before` filter to any route or route group.

## Problems?

If a new module is added, then you might get an error when rendering a previous request.

Here's some things you can try if you have any problems. First you can try updating Anbu with:

    composer update

Secondly you can clear the previous requests with the following Artisan command.

    php artisan anbu:clear

Let me know about other issues!
