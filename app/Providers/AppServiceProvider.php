<?php

namespace App\Providers;

use App\Repositories\BicicletaEloquentRepository;
use App\Repositories\Contracts\BicicletaRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    // Definimos un mapa de las implementaciones que el inyector de dependencias de Laravel debe darnos
    // para ciertas interfaces.
    public array $bindings = [
        // Acá le decimos que cuando al inyector de dependencias le pidan una instancia de la "interface"
        // BicicletaRepository, pase una instancia de la clase BicicletaEloquentRepository.
        BicicletaRepository::class => BicicletaEloquentRepository::class,
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
