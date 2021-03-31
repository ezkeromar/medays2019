<?php

namespace App\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class LocalEnvironmentServiceProvider extends ServiceProvider
{
    /**
     * List of Local Environment Providers.
     *
     * @var array
     */
    protected $localProviders = [
    ];

    /**
     * List of only Local Environment Facade Aliases.
     *
     * @var array
     */
    protected $facadeAliases = [
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Load local service providers.
     */
    protected function registerServiceProviders()
    {
        foreach ($this->localProviders as $provider) {
            $this->app->register($provider);
        }
    }

    /**
     * Load additional Aliases.
     */
    public function registerFacadeAliases()
    {
        $loader = AliasLoader::getInstance();
        foreach ($this->facadeAliases as $alias => $facade) {
            $loader->alias($alias, $facade);
        }
    }
}
