<?php

namespace Bluedot\Unit\Providers;

use Bluedot\Unit\Classes\ClientBuilder;
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
        $this->app->bind("BluedotUnitClient", function (){
            $builder = new ClientBuilder();
            $builder->setTokenService()
                    ->setAccountService();

            return $builder->build();
        });
    }
}
