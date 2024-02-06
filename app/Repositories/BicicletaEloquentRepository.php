<?php

namespace App\Repositories;

use App\Models\Bicicleta;
use App\Repositories\Contracts\BicicletaRepository;
use App\SearchParams\BicicletaSearchParams;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class BicicletaEloquentRepository implements BicicletaRepository
{
    // private Bicicleta $bicicleta;
    private Builder $builder;

    public function __construct() 
    {
        // $this->bicicleta = New Bicicleta();
        // Creamos un query builder para las bicicletas
        $this->builder = Bicicleta::query();
    }

    public function withRelations(array $relations): self
    {
        $this->builder->with($relations);
        return $this;
    }

    public function where(BicicletaSearchParams $searchParams): self
    {
        if($searchParams->getModelo()) {
            $this->builder->where('modelo', 'like', '%' . $searchParams->getModelo() . '%');
        }

        return $this;
    }

    public function paginate(int $perPage) {
        return $this->builder->paginate($perPage)->withQueryString();
    }

    public function get() {
        return $this->builder->get();
    }

    public function findOrFail(int $pk) {
        return Bicicleta::findOrFail($pk);
    }

    public function create(array $data) {
        DB::transaction(function() use ($data) {
            $bicicleta = Bicicleta::create($data);
            $bicicleta->marcas()->attach($data["marca_id"] ?? []);
        });
    }

    public function update(int $pk, array $data) {
        $bicicleta = $this->findOrFail($pk);

        DB::transaction(function() use ($bicicleta, $data) {
            $bicicleta->update($data);
            $bicicleta->marcas()->sync($data["marca_id"] ?? []);
        });
    }

    public function delete(int $pk) {
        $this->findOrFail($pk)->delete();
    }
}