<?php

namespace Bluedot\Unit\Providers;

use Bluedot\Unit\Client;
use Illuminate\Support\ServiceProvider;

class UnitServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()){
            // publish config
            $this->publishes([
                __DIR__."/../../config/bluedot-unit.php" => config_path("bluedot-unit.php")
            ], "bluedot-unit");

            // commands integration
            $this->commands([]);
        }
    }


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind('ClientFacade', function (){
            return new Client();
        });
    }
}
