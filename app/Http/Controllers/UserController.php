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

        return view("user.index", [
            "user" => $user,
            "compras" => $compras,
        ]);
    }

    public function formUpdate() {
        $user = Auth::user();

        return view("user.form-update", [
            "user" => $user,
        ]);
    }

    public function processUpdate(Request $request) {
        // Validar los datos enviados por el formulario de actualización
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            // 'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'telefono' => 'nullable|string|max:20',
        ]);

        // Obtener el usuario actualmente autenticado
        $user = Auth::user();

        // Actualizar los campos del usuario con los datos del formulario
        $user->nombre = $request->input('nombre');
        $user->apellido = $request->input('apellido');
        // $user->email = $request->input('email');
        $user->telefono = $request->input('telefono');

        // Guardar los cambios en la base de datos
        $user->save();

        // Redirigir de vuelta a la página de perfil con un mensaje de éxito
        return redirect()
            ->route('user.index')
            ->with('feedback.message', "¡Tus datos han sido actualizados correctamente!")
            ->with('feedback.type', 'success');
    }
}
