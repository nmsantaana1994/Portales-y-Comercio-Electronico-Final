<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Compra;

class UserController extends Controller
{
    public function showPerfil(){
        $user = Auth::user();
        $compras = Compra::where('user_id', $user->user_id)->with('bicicletas')->get();

        Log::debug("Usuario:", [
            "user" => $user,
            "compras" => $compras,
        ]);

        return view("user.index", [
            "user" => $user,
            "compras" => $compras,
        ]);
    }
}
