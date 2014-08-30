<?php

use Mockery as M;
use Anbu\Profiler;
use Anbu\Modules\Module;
use Illuminate\Foundation\Application;

class ProfilerTest extends PHPUnit_Framework_TestCase
{
    public function testThatProfilerCanBeCreated()
    {
        $p = new Profiler;
    }

    public function testThatDefaultModulesCanBeSet()
    {
        $p = new Profiler;
        $p->setDefaultModules([
            'FirstDummyModule',
            'SecondDummyModule'
        ]);
    }

    public function testThatProfilerCanRegisterModules()
    {
        $p = new Profiler;
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
