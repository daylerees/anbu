[ ![Codeship Status for daylerees/anbu](https://www.codeship.io/projects/1657b700-1681-0132-af64-5ae52864a4c1/status?branch=master)](https://www.codeship.io/projects/33889)

![Packagist Version](http://img.shields.io/packagist/v/daylerees/anbu.svg?style=flat-square)
![Packagist License](http://img.shields.io/packagist/l/daylerees/anbu.svg?style=flat-square)
![Packagist Downloads](http://img.shields.io/packagist/dt/daylerees/anbu.svg?style=flat-square)
![Github Issues](http://img.shields.io/github/issues/daylerees/anbu.svg?style=flat-square)

# Anbu Profiler for Laravel PHP

## Notice

This profiler is still **WORK IN PROGRESS**. Don't get me wrong, it works just fine, but don't file issues or PRs yet!

## Installation

First ensure that you have a database, and that it is configured with Laravel.

Next add the following service provider to `app/config/app.php`:

    'Anbu\ProfilerServiceProvider',

Next use the `asset:publish` command for Artisan to publish profiler asset files.

    php artisan asset:install

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

