<?php

namespace Ribafs\CrudGenerator;

use Illuminate\Support\ServiceProvider;

class CrudGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/crudgenerator.php' => config_path('crudgenerator.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../publish/views/' => base_path('resources/views/'),
        ]);

        $this->publishes([
            __DIR__ . '/stubs/' => base_path('resources/crud-generator/'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(
            'Ribafs\CrudGenerator\Commands\CrudCommand',
            'Ribafs\CrudGenerator\Commands\CrudControllerCommand',
            'Ribafs\CrudGenerator\Commands\CrudModelCommand',
            'Ribafs\CrudGenerator\Commands\CrudMigrationCommand',
            'Ribafs\CrudGenerator\Commands\CrudViewCommand',
            'Ribafs\CrudGenerator\Commands\CrudLangCommand',
            'Ribafs\CrudGenerator\Commands\CrudApiCommand',
            'Ribafs\CrudGenerator\Commands\CrudApiControllerCommand'
        );
    }
}
