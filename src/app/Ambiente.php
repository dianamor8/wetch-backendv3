<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambiente extends Model
{
    protected $table = 'ambientes'; 

    protected $fillable = [
        'nombre', 'descripcion', 'propietario'
    ];
    
    public function areas()
    {
        return $this->hasMany('App\AreaVivienda');
    }
}
