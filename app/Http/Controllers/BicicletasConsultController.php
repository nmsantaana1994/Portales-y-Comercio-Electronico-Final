<?php

namespace App\Http\Controllers;

use App\Mail\BicicletasConsult;
use App\Models\Bicicleta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BicicletasConsultController extends Controller
{
    public function processConsult(Request $request, int $id) {
        // TODO: La lógica para la consulta

        // Una vez hecha la consulta, podemos querer enviar al usuario un email que le confirme que su
        // consulta se realizó y que le sirva de comprobante.
        // En el send() tenemos que pasar la instancia de Mailable que queremos enviar.
        $bicicleta = Bicicleta::findOrFail($id);

        Mail::to($request->query())->send(new BicicletasConsult($bicicleta));

        return redirect()
            ->route('bicicletas.index')
            ->with('feedback-message', 'La consulta se realizó con éxito.');
    }
}
