<?php

namespace Anbu\Commands;

use Schema;
use Exception;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'anbu:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Anbu profiler.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        // Welcome.
        $this->info('Anbu Laravel Profiler');
        $this->info('---------------------');

        // Confirmation.
        $result = $this->confirm('This profiler requires the creation of an \'anbu\' table in the database, shall I create this for you now? [Y/N]');

        // Switch.
        if ($result) {

            // Working...
            $this->info("\n*fiddle* *fiddle* *fiddle*\n");

            // Suppress error here.
            try {

                // Drop table.
                Schema::drop('anbu');

            } catch (Exception $e) {
                // No worries!
            }

            // Create anbu table schema.
            Schema::create('anbu', function ($table) {
                $table->increments('id');
                $table->longText('storage');
                $table->timestamps();
            });

            // Friendly jibba jabba.
            $this->info('Great! All done. :)');
            $this->info('I hope you enjoy using Anbu!');
            $this->info('- Love Dayle. xx');
            return;
        }

        // Back away slowly.
        $this->info('Oh, okay. Run me again when you\'re ready, okay?');
    }
}
