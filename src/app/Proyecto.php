<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    //
    protected $table = 'proyectos';

    public function usuario()
    {
        return $this->belongsTo('App\User');
    }

    public function ubicacion()
    {
        return $this->belongsTo('App\Ubicacion');
    }
}
