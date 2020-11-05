<?php

namespace App\Support;

use Illuminate\Support\ServiceProvider;

/**
 * Register our pokemon service with Laravel
 */
class ApiErrorHandlerServiceProvider extends ServiceProvider
{
    /**
     * Registers the service in the IoC Container
     *
     */
    public function register()
    {
        // Binds 'pokemonService' to the result of the closure
        $this->app->bind('apiErrorHandlerService', function($app)
        {
            return new ApiErrorHandler(
            // Inject in our class of pokemonInterface, this will be our repository
            );
        });
    }
}