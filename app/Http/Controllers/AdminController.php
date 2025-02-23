<?php

namespace App\Http\Controllers;

use App\Models\Bicicleta;
use App\Models\Colores;
use App\Models\Marca;
use App\Models\Compra;
use App\Models\Noticia;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BicicletaRepository;
use App\SearchParams\BicicletaSearchParams;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    private BicicletaRepository $repo;

    public function __construct(BicicletaRepository $repo)
    {
        $this->repo = $repo;
    }
    
    public function dashboard(Request $request)
    {
        // Obtener la bicicleta más vendida
        $bicicletaMasVendida = Bicicleta::withCount('compras')
            ->orderByDesc('compras_count')
            ->first();

        if ($bicicletaMasVendida) {
            $cantidadTotalVendida = $bicicletaMasVendida->compras->sum('pivot.cantidad');
            $totalRecaudadoBicicletaMasVendida = $bicicletaMasVendida->precio * $cantidadTotalVendida;
        } else {
            $cantidadTotalVendida = 0;
            $totalRecaudadoBicicletaMasVendida = 0;
        }

        // Obtener el total recaudado
        $totalRecaudado = Compra::sum('monto_total');

        // Obtener los detalles de la compra de cada usuario
        $detallesComprasPorUsuario = DB::table('users')
            ->join('compras', 'users.user_id', '=', 'compras.user_id')
            ->join('compra_bicicleta', 'compras.id', '=', 'compra_bicicleta.compra_id')
            ->join('bicicletas', 'compra_bicicleta.bicicletas_id', '=', 'bicicletas.bicicletas_id')
            ->select('users.nombre', 'bicicletas.marca', 'bicicletas.modelo', 'compra_bicicleta.cantidad')
            ->get();

        return view("admin.dashboard", [
            'bicicletaMasVendida' => $bicicletaMasVendida,
            'cantidadTotalVendida' => $cantidadTotalVendida,
            'totalRecaudadoBicicletaMasVendida' => $totalRecaudadoBicicletaMasVendida,
            'totalRecaudado' => $totalRecaudado,
            'detallesComprasPorUsuario' => $detallesComprasPorUsuario,
        ]);

        // $searchParams = new BicicletaSearchParams($request->query());
        // $bicicletas = $this->repo
        //     ->withRelations(['color', "marcas"])
        //     ->where($searchParams)
        //     ->paginate(2);

        // return view("admin.dashboard", [
        //     'bicicletas'=>$bicicletas,
        //     'searchParams'=>$searchParams,
        // ]);
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
        $users = User::with('compras.bicicletas')->get();

        return view("admin.users", [
            "users" => $users,
        ]);
    }

}