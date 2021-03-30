<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoAreaVivienda extends Model
{
    protected $table = 'tipo_area_viviendas';    
    protected $fillable = [
        'nombre', 'factorCirculacionParedes', 'factorDireccionTecnica', 'propietario'
    ];
}
