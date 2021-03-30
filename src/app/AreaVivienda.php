<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AreaVivienda extends Model
{    
    protected  $table = 'area_viviendas';

    protected $fillable = [
        'area', 'unidadMedida', 'TipoAreaVivienda_id', 'propietario'
    ];

    public function tipoAreaVivienda()
    {
        return $this->belongsTo('App\TipoAreaVivienda');
    }
}
