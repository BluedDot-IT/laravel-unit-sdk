<?php

namespace BluedotDev\Unit\Providers;

use BluedotDev\Unit\Classes\ClientBuilder;
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
        $this->app->bind("BluedotDevUnitClient", function (){
            $builder = new ClientBuilder();
            $builder->setTokenService()
                    ->setAccountService()
                    ->setTransactionService();

            return $builder->build();
        });
    }
}
