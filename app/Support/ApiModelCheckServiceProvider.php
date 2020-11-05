<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class ApiModelCheckServiceProvider extends ServiceProvider{

    public function register()
    {
        $this->app->bind('apiModelCheckService', function($app)
        {
            return new ApiModelCheckService(
            // Inject in our class of pokemonInterface, this will be our repository
                //$app->make('Repositories\Pokemon\PokemonInterface')
            );
        });
    }
}