<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory as EloquentFactory;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            EloquentFactory::guessFactoryNamesUsing(function (string $modelName) {
                return 'Database\\Factories\\' . class_basename($modelName) . 'Factory';
            });
        }
    }
}
