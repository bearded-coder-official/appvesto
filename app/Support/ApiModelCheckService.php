<?php

namespace App\Support;

//use Repositories\Pokemon\PokemonInterface;

use Illuminate\Http\Request;
use App\Models\Entities\Educand;
use Illuminate\Database\Eloquent\Model;

class ApiModelCheckService
{

    const MODEL_ARRAY = [
        'Event' => 'event not found'
    ];


    public function checkModel($model)
    {
       // dd($model);
        //return $request->route('event');

    }
}
