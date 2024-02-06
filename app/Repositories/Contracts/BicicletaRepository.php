<?php
namespace App\Repositories\Contracts;

use App\SearchParams\BicicletaSearchParams;

interface BicicletaRepository
{
    public function withRelations(array $relations): self;

    public function where(BicicletaSearchParams $searchParams): self;

    public function paginate(int $perPage);

    public function get();

    public function findOrFail(int $pk);

    public function create(array $data);

    public function update(int $pk, array $data);

    public function delete(int $pk);
}