[ ![Codeship Status for daylerees/anbu](https://www.codeship.io/projects/1657b700-1681-0132-af64-5ae52864a4c1/status?branch=master)](https://www.codeship.io/projects/33889)

![Packagist Version](http://img.shields.io/packagist/v/daylerees/anbu.svg?style=flat-square)
![Packagist License](http://img.shields.io/packagist/l/daylerees/anbu.svg?style=flat-square)
![Packagist Downloads](http://img.shields.io/packagist/dt/daylerees/anbu.svg?style=flat-square)
![Github Issues](http://img.shields.io/github/issues/daylerees/anbu.svg?style=flat-square)
# Notice

This profiler is still **WORK IN PROGRESS**. Don't get me wrong, it works, but don't file issues or PRs yet!

# Installation

Simply add the following service provider to `app/config/app.php`:

    'providers' => array(

        'Illuminate\Foundation\Providers\ArtisanServiceProvider',
        'Illuminate\Auth\AuthServiceProvider',
        'Illuminate\Cache\CacheServiceProvider',
        ... more ...

        'Anbu\ProfilerServiceProvider',

    ),

Now simply ensure that you've setup a database connection, visit any page of your site, and then:

    YOUR_APP_HOST_HERE/anbu

or just click the Laravel icon in the lower left of any request.

If you want to use Anbu timers, you'll need to include the Facade in the same config file:

    'aliases' => array(

        'App'             => 'Illuminate\Support\Facades\App',
        'Artisan'         => 'Illuminate\Support\Facades\Artisan',
        'Auth'            => 'Illuminate\Support\Facades\Auth',
        'Blade'           => 'Illuminate\Support\Facades\Blade',
        'Cache'           => 'Illuminate\Support\Facades\Cache',
        ... more ...

        'Anbu'            => 'Anbu\Facades\Anbu',
    ),

Now you can create timers like this:

    Anbu::timers()->start('test');
    sleep(30); // Do something interesting.
    Anbu::timers()->end('test', 'Completed doing something.');

Better docs soon! As I said... WIP.

Enjoy!
