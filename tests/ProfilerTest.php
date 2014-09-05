<?php

use Mockery as M;
use Anbu\Profiler;
use Anbu\Modules\Module;
use Illuminate\Foundation\Application;

class ProfilerTest extends PHPUnit_Framework_TestCase
{
    public function testThatProfilerCanBeCreated()
    {
        $p = new Profiler(new Repo);
    }

    public function testThatDefaultModulesCanBeSet()
    {
        $p = new Profiler(new Repo);
        $p->setDefaultModules([
            'FirstDummyModule',
            'SecondDummyModule'
        ]);
    }

    public function testThatProfilerCanRegisterModules()
    {
        $p = new Profiler(new Repo);
        $p->setDefaultModules([
            'FirstDummyModule',
            'SecondDummyModule'
        ]);
        $a = new Application;
        $c = M::mock('Illuminate\\Config\\Repository');
        $c->shouldReceive('get')->once()->andReturn([]);
        $a->instance('config', $c);
        $p->registerModules($a);
    }
}

// Dummy Module

class FirstDummyModule extends Module
{

}

class SecondDummyModule extends Module
{

}

class Repo implements Anbu\Repositories\Repository
{
    public function get($key = null){}
    public function put(Anbu\Models\Storage $storage){}
    public function all(){}
    public function clear(){}
}
