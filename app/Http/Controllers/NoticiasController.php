<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NoticiasController extends Controller
{
    public function noticias_index(){
        $noticias = Noticia::all();

        return view("noticias.index", [
            "noticias"=>$noticias,
        ]);
    }

    public function view(int $id){
        $noticia = Noticia::findOrFail($id);

        return view("noticias.view", [
            "noticia"=> $noticia,
        ]);
    }

    public function formUpdate(int $id){
        return view("noticias.form-update", [
            "noticia" => Noticia::findOrFail($id),
        ]);
    }

    public function formNew(){
        return view("noticias.form-new");
    }

    public function processNew(Request $request){
        $data = $request->except(["_token"]);

        $request->validate(Noticia::validationRules(), Noticia::validationMessages());

        if ($request->hasFile("foto")) {
            $data["foto"] = $this->uploadFoto($request);
        }

        Noticia::create($data);

        return redirect()
            ->route("admin.noticias")
            ->with('feedback-message', 'La nota <b>' . e($data['titulo']) . '</b> se publicó con éxito.');
    }

    public function processUpdate(int $id, Request $request){
        $noticia = Noticia::findOrFail($id);

        $request->validate(Noticia::validationRules(), Noticia::validationMessages());

        $data = $request->except(["_token"]);

        $oldFoto = null;

        if ($request->hasFile("foto")) {
            $data["foto"] = $this->uploadFoto($request);
            $oldFoto = $noticia->foto;
        }

        $noticia->update($data);

        $this->deleteFoto($oldFoto);

        return redirect()
            ->route("admin.noticias")
            ->with("feedback.message", 'La nota <b>' . e($data['titulo']) . '</b> se editó con éxito.');
    }


    /**
     * Sube la foto de la bicicleta
     * Retorna el modelo de la bicicleta
     * 
     * @param Request $request
     * @return string El nombre del archivo de la foto
     */
    protected function uploadFoto(Request $request): string {
        $foto = $request->file("foto");

        $fotoName = date("YmdHis_") . Str::slug($request->input("titulo")) . "." . $foto->guessExtension();

        $foto->storeAs("img", $fotoName);

        return $fotoName;
    }

    /**
     * Borra la foto de la bicicleta
     * 
     * @param string|null $file
     * @return void
     */
    protected function deleteFoto(?string $file): void {
        // if($file !== null && file_exists(public_path("img/" . $file))){
        //     unlink(public_path("img/" . $file));
        // }
        
        // API Storage
        if($file !== null && Storage::has("img/" . $file)){
            Storage::delete("img/" . $file);
        }
    }

    public function confirmDelete(int $id) {
        return view("noticias.confirm-delete", [
            "noticia" => Noticia::findOrFail($id)
        ]);
    }

    public function processDelete(int $id) {
        $noticia = Noticia::findOrFail($id);

        $noticia->delete();

        $this->deleteFoto($noticia->foto);

        return redirect()
            ->route("admin.noticias")
            ->with("feedback.message", 'La nota <b>' . e($noticia['titulo']) . '</b> se eliminó con éxito.');
    }
}
