<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;

class AuthController extends Controller
{
    public function formLogin() {

        return view("auth.form-login");

    }

    public function processLogin(Request $request) {

        // TODO: Validar...

        $credentials = $request->only(["email", "password"]);

        if (!auth()->attempt($credentials)) {
            // Error, las credenciales no son correctas.
            return redirect()
                ->route("auth.formLogin")
                ->with("feedback.message", "Las credenciales ingresadas no coinciden con nuestros registros.")
                ->with("feedback.type", "danger")
                ->withInput();
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->rol === "admin") {
            return redirect()
                ->route("admin.dashboard")
                ->with("feedback.message", "Sesión iniciada con exitó. ¡Hola de nuevo!");
        } else {
            return redirect()
                ->route("bicicletas.index")
                ->with("feedback.message", "Sesión iniciada con exitó. ¡Hola de nuevo!");
        }
    }

    public function processLogout(Request $request) {
        
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()
            ->route("auth.formLogin")
            ->with("feedback.message", "La sesión se cerro con éxito. ¡Te esperamos de nuevo pronto!");
    }

    public function formRegister() {
        return view("auth.form-register");
    }

    public function processRegister(Request $request) {
        $data = $request->except(['_token']);
        $data['password'] = Hash::make($data['password']);
        $data['rol'] = "user";
        User::create($data);
        return redirect()
            ->route('auth.formLogin')
            ->with('feedback.message', 'Bienvenid@ a nuestra comunidad <b>' . e($data['email']) . '</b>');
    }
}
