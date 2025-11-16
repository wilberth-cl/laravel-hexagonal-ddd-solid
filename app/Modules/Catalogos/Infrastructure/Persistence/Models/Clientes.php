<?php

namespace App\Modules\Catalogos\Infrastructure\Persistence\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $table = "clientes";

    protected $primaryKey = ['id'];

    public $timestamps = false;


    protected $fillable = [
        'id',
        'nombre',
        'apellidos',
        'edad',
        'email',
        'curp'
    ];
}
