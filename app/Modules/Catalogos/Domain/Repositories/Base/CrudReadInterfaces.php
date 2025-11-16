<?php

namespace App\Modules\Catalogos\Domain\Repositories\Base;

/**
 * Interface para CRUD generica de lectura
 */
interface CrudReadInterfaces
{
    /**
     * Obtener todos los registros (opcionalmente con filtros)
     *
     * @param array $filters
     * @return mixed
     */
    public function all(array $filters = []);

    /**
     * Obtener registros paginados
     *
     * @param int $perPage
     * @param array $filters
     * @return mixed
     */
    public function paginate(int $perPage = 15, int $page = 1, array $filters = []);

    /**
     * Buscar un registro por su ID
     *
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

}