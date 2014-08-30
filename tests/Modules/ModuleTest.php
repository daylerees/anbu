<?php

use Anbu\Modules\Module;

class ModuleTest extends PHPUnit_Framework_TestCase
{
    public function testThatModuleCanBeImplemented()
    {
        $d = new DummyModule;
    }

    public function testThatModuleNameCanBeRetrieved()
    {
        $d = new DummyModule;
        $this->assertEquals('Dummy Module', $d->getName());
    }

    public function testThatModuleSlugCanBeRetrieved()
    {
        $d = new DummyModule;
        $this->assertEquals('dummy-module', $d->getSlug());
    }

    public function testThatModuleDescriptionCanBeRetrieved()
    {
        $d = new DummyModule;
        $this->assertEquals('This is a dummy module.', $d->getDescription());
    }

    public function testThatModuleTemplateCanBeRetrieved()
    {
        $d = new DummyModule;
        $this->assertEquals('default', $d->getTemplate());
    }

    public function testThatModuleAssetsCanBeRetrieved()
    {
        $d = new DummyModule;
        $this->assertEquals(['foo.js', 'bar.css'], $d->getAssets());
    }

    public function testThatModuleDataCanBeRetrieved()
    {
        $d = new DummyModule;
        $this->assertEquals(['foo', 'bar', 'baz'], $d->getData());
    }

    public function testThatApplicationCanBeSet()
    {
        $a = new Illuminate\Foundation\Application;
        $d = new DummyModule;
        $d->setApplication($a);
    }
}

// Dummy Module

class DummyModule extends Module
{
    /**
     * The display name of the module.
     *
     * @var string
     */
    protected $name = 'Dummy Module';

    /**
     * The short or URL friendly name of the module.
     *
     * @var string
     */
    protected $slug = 'dummy-module';

    /**
     * A description of the modules purpose.
     *
     * @var string
     */
    protected $description = 'This is a dummy module.';

    /**
     * Get the template view for this module.
     *
     * @var string
     */
    protected $template = 'default';

    /**
     * An array of accessible assets.
     *
     * @var array
     */
    protected $assets = ['foo.js', 'bar.css'];

    /**
     * An array of data for the rendering of this module.
     *
     * @var array
     */
    protected $data = ['foo', 'bar', 'baz'];
}
