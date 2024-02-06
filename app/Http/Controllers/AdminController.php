<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use App\Models\Colores;
use App\Models\Marca;
use App\Models\Noticia;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BicicletaRepository;
use App\SearchParams\BicicletaSearchParams;
use Barryvdh\Debugbar\Facades\Debugbar;

class AdminController extends Controller
{
    private BicicletaRepository $repo;

    public function __construct(BicicletaRepository $repo)
    {
        $this->repo = $repo;
    }
    
    public function dashboard(Request $request)
    {
        $searchParams = new BicicletaSearchParams($request->query());
        $bicicletas = $this->repo
            ->withRelations(['color', "marcas"])
            ->where($searchParams)
            ->paginate(2);

        return view("admin.dashboard", [
            'bicicletas'=>$bicicletas,
            'searchParams'=>$searchParams,
        ]);
    }

    // Bicicletas
    public function bicicletas(Request $request)
    {
        $searchParams = new BicicletaSearchParams($request->query());
        $bicicletas = $this->repo
            ->withRelations(['color', "marcas"])
            ->where($searchParams)
            ->paginate(2);

        return view("admin.bicicletas", [
            'bicicletas'=>$bicicletas,
            'searchParams'=>$searchParams,
        ]);
    }

    public function bicicletas_view(int $id)
    {
        $bicicleta = $this->repo->findOrFail($id);

        return view("admin.bicicletas_view", [
            "bicicleta" => $bicicleta,
        ]);
    }

    // Noticias
    public function noticias()
    {
        $noticias = Noticia::all();

        return view("admin.noticias", [
            "noticias"=>$noticias,
        ]);
    }

    public function noticias_view(int $id){
        $noticia = Noticia::findOrFail($id);

        return view("admin.noticias_view", [
            "noticia"=> $noticia,
        ]);
    }

    //Usuarios
    public function users()
    {
        $users = User::with('bicicletas')->get();

        return view("admin.users", [
            "users"=>$users,
        ]);
    }
}