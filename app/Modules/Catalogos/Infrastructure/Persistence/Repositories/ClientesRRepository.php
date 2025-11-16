<?php

namespace App\Modules\Catalogos\Infrastructure\Persistence\Repositories;

use App\Modules\Catalogos\Domain\Repositories\ClienteRInterface;
use App\Modules\Catalogos\Infrastructure\Persistence\Models\Clientes;

class ClientesRRepository implements ClienteRInterface
{

    public function all(array $filters = [])
    {
        $clienets = Clientes::all();
        return $clienets;
    }


    public function paginate(int $perPage = 15, int $page = 1, array $filters = [])
    {
        $query = Clientes::query();

        // Aplicar filtros si los hay
        foreach ($filters as $field => $value) {
            $query->where($field, $value);
        }

        $total = $query->count();
        $results = $query->skip(($page - 1) * $perPage)
                         ->take($perPage)
                         ->get();

        return [
            'data' => $results,
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'last_page' => ceil($total / $perPage),
        ];
    }


    public function find(int $id)
    {
        return Clientes::find($id);
    }
}

