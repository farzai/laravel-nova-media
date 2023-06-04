<?php

namespace Farzai\NovaMedia\Tests;

use Farzai\NovaMedia\NovaMediaServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        // Factory::guessFactoryNamesUsing(
        //     fn (string $modelName) => 'Farzai\\NovaMedia\\Database\\Factories\\'.class_basename($modelName).'Factory'
        // );
    }

    protected function getPackageProviders($app)
    {
        return [
            NovaMediaServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        // Using package migrations...
        $migration = include __DIR__.'/../vendor/spatie/laravel-medialibrary/database/migrations/create_media_table.php.stub';
        $migration->up();

        /*
        $migration = include __DIR__.'/../database/migrations/create_laravel-nova-media_table.php.stub';
        $migration->up();
        */
    }
}
