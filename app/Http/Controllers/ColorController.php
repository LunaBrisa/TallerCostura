<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function saveColor(SaveColorRequest $ColorRequest){
        $colorsillo = new Color();
        $colorsillo -> color = $ColorRequest -> colorsito;
        $colorsillo -> save();

        return redirect('/gestion/catalogo');
    }
}
