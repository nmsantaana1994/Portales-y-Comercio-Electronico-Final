<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use App\Models\Colores;
use App\Models\Marca;
use App\Repositories\Contracts\BicicletaRepository;
use App\SearchParams\BicicletaSearchParams;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BicicletasController extends Controller
{
    private BicicletaRepository $repo;

    // Le pedimos al inyector de dependencias de Laravel que nos pase la instancia de BicicletaEloquentRepository
    // cuando instancie el Controller
    // Si preferimos usar una interface, como estamos haciendo ahora, vamos a necesitar avisarle a Laravel
    // en algún ServiceProvider (AppServiceProvider, en este caso) cuál es la clase concreta que queremos
    // que nos pase de esta abstracción.
    public function __construct(BicicletaRepository $repo)
    {
        $this->repo = $repo;
    }

    public function bicicletas_index(Request $request)
    {
        // Buscador
        // Para Hacer el buscador, vamos a separar en partes los metodos de la consulta.
        // Es decir, dejar la llamada del "get()" al final.
        // Cuando hacemos un buscador, necesitamos agregar nuevas clausulas al WHERE.
        // Por lo tanto, necesitamos hacerlo antes del "get()", que es el que ejecuta el query.
        // $query = Bicicleta::with(['color', "marcas"]);

        // En el medio de la creación del query y su ejecución, podemos manejar el tema de los parámetros
        // de busqueda.
        // Como son datos que llegan en la petición (en este caso, el quey string), le vamos a pedir a la
        // clase Request que nos los proporcione.
        // $searchParams = $request->query();
        // $searchParams = new BicicletaSearchParams($request->query());

        // if($searchParams->getModelo()) {
        //     $query->where('modelo', 'like', '%' . $searchParams->getModelo() . '%');
        // }

        // $bicicletas = $query->get();
        // Reemplazamos el "get()" con "paginate()" para pedir que los resultados vengan paginados
        // withQueryString() nos permite sumar todo el query string actual a los links de la paginación.
        // $bicicletas = $query->paginate(2)->withQueryString();

        $searchParams = new BicicletaSearchParams($request->query());
        $bicicletas = $this->repo
            ->withRelations(['color', "marcas"])
            ->where($searchParams)
            ->paginate(3);

        return view("bicicletas.index", [
            'bicicletas'=>$bicicletas,
            // Pasamos los parámetros del query string a la vista para que podamos poblar el form.
            'searchParams'=>$searchParams,
        ]);
    }

    public function view(int $id)
    {
        // $bicicleta = Bicicleta::findOrFail($id);

        // Cambiamos a usar el repositorio.
        $bicicleta = $this->repo->findOrFail($id);

        return view("bicicletas.view", [
            "bicicleta" => $bicicleta,
        ]);
    }

    public function formNew()
    {
        return view("bicicletas.form-new", [
            "colores" => Colores::all(),
            "marcas" => Marca::orderBy("nombre")->get(),
        ]);
    }

    public function processNew(Request $request)
    {
        $data = $request->except(["_token"]);
        
        $request->validate(Bicicleta::validationRules(), Bicicleta::validationMessages());

        if ($request->hasFile("foto")) {
            $data["foto"] = $this->uploadFoto($request);
        }
        
        try {
            // DB::transaction(function() use ($data) {
            //     $bicicleta = Bicicleta::create($data);
            //     $bicicleta->marcas()->attach($data["marca_id"] ?? []);
            // });

            $this->repo->create($data);

            return redirect()
                ->route('admin.bicicletas')
                ->with('feedback.message', 'La bicicleta <b>' . e($data['marca']) . ' ' . e($data['modelo']) . '</b> se publicó con éxito.');
        } catch (\Exception $e) {
            // Debugbar::log($e);
            return redirect()
            ->route("bicicletas.formNew")
            ->withInput()
            ->with('feedback.message', "Ocurrió un error al tratar de crear la bicicleta. Por favor, probá de nuevo en un rato. Y si el problema persiste, comunicate con nosotros.")
            ->with('feedback.type', 'danger');
        }
    }

    public function formUpdate(int $id) {
        return view("bicicletas.form-update", [
            "bicicleta" => Bicicleta::findOrFail($id),
            "colores" => Colores::all(),
            "marcas" => Marca::orderBy("nombre")->get(),
        ]);
    }

    public function processUpdate(int $id, Request $request) {
        try {
            // $bicicleta = Bicicleta::findOrFail($id);
            $bicicleta = $this->repo->findOrFail($id);

            $request->validate(Bicicleta::validationRules(), Bicicleta::validationMessages());

            $data = $request->except(['_token']);
            $oldFoto = null;

            if ($request->hasFile("foto")) {
                $data["foto"] = $this->uploadFoto($request);
                $oldFoto = $bicicleta->foto;
            }
            
            // DB::transaction(function() use ($bicicleta, $data) {
            //     $bicicleta->update($data);
            //     $bicicleta->marcas()->sync($data["marca_id"] ?? []);
            // });
            $this->repo->update($id, $data);

            $this->deleteFoto($oldFoto);

            return redirect()
                ->route("admin.bicicletas")
                ->with("feedback.message", 'La bicicleta <b>' . e($bicicleta['marca']) . ' ' . e($bicicleta['modelo']) . '</b> se editó con éxito.');
        } catch (\Exception $e) {
            return redirect()
            ->route("bicicletas.formUpdate", ["id" => $id])
            ->withInput()
            ->with('feedback.message', "Ocurrió un error al tratar de editar la bicicleta. Por favor, probá de nuevo en un rato. Y si el problema persiste, comunicate con nosotros.")
            ->with('feedback.type', 'danger');
        }

        
    }

    public function confirmDelete(int $id) {
        return view('bicicletas.confirm-delete', [
            'bicicleta' => $this->repo->findOrFail($id),
        ]);
    }

    public function processDelete(int $id) {
        try {
            // $bicicleta = Bicicleta::findOrFail($id);
            $bicicleta = $this->repo->findOrFail($id);

            // DB::transaction(function() use ($bicicleta) {
            //     // Como estamos usando soft deletes, no hace falta que borremos la relación.
            //     // $bicicleta->marcas()->detach();
            //     $bicicleta->delete();
            // });
            $this->repo->delete($id);

            $this->deleteFoto($bicicleta->foto);

            return redirect()
                ->route('admin.bicicletas')
                ->with('feedback.message', 'La bicicleta <b>' . e($bicicleta['marca']) . ' ' . e($bicicleta['modelo']) . '</b> se eliminó con éxito.');
        } catch(\Exception $e) {
            return redirect()
                ->route("bicicletas.confirmDelete", ["id" => $id])
                ->with('feedback.message', "Ocurrió un error al tratar de eliminar la bicicleta. Por favor, probá de nuevo en un rato. Y si el problema persiste, comunicate con nosotros.")
                ->with('feedback.type', 'danger');
        }
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

        $fotoName = date("YmdHis_") . Str::slug($request->input("modelo")) . "." . $foto->guessExtension();

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
        if($file !== null && Storage::has("img/" . $file)){
            Storage::delete("img/" . $file);
        }
    }
}

