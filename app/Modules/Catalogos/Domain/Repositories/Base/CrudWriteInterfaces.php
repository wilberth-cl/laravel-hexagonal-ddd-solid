<?php

namespace App\Modules\Catalogos\Domain\Repositories\Base;

/**
 * Interface para CRUD genericas de escritura
 */
interface CrudWriteInterfaces
{

    /**
     * Buscar un registro por su ID
     *
     * @param int $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * Crear un nuevo registro
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Actualizar un registro existente
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update(int $id, array $data);

    /**
     * Eliminar un registro (soft delete si aplica)
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;


    /**
     * Eliminar permanentemente un registro
     *
     * @param int $id
     * @return bool
     */
    public function forceDelete(int $id): bool;
}