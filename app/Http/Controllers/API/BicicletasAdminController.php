<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bicicleta;
use Illuminate\Http\Request;

class BicicletasAdminController extends Controller
{
    public function index(){
        // Para retornar JSONs con Laravel, tenemos que usar el response()->json().
        return response()->json([
            "status" => 0,
            "data" => Bicicleta::all(),
        ]);
    }

    public function view(int $id){
        return response()->json([
            "status" => 0,
            "data" => Bicicleta::findOrFail($id),
        ]);
    }

    public function create(Request $request){
        // TODO: Validar...

        Bicicleta::create($request->all());

        return response()->json([
            "status" => 0,
        ]);
    }
}
