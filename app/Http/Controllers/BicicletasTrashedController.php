<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use Illuminate\Http\Request;

class BicicletasTrashedController extends Controller
{
    public function index() {
        // Si queremos traer las bicicletas eliminadas, entonces podemos usar el método onlyTrashed().
        $bicicletas = Bicicleta::onlyTrashed()->with(['color', 'marcas'])->get();

        return view('bicicletas.trashed.index', [
            'bicicletas' => $bicicletas,
        ]);
    }

    public function view(int $id) {
        return view('bicicletas.trashed.view', [
            'bicicleta' => Bicicleta::onlyTrashed()->findOrFail($id),
        ]);
    }

    public function processRestore(int $id) {
        $bicicleta = Bicicleta::onlyTrashed()->findOrFail($id);

        $bicicleta->restore();

        return redirect()
            ->route('bicicletas.trashed.index')
            ->with('feedback.message', 'La bicicleta <b>' . $bicicleta->marca . '' . $bicicleta->modelo . '</b> fue restaurada con éxito.');
    }
}
