<?php

namespace App\Http\Resources;

use App\TipoAreaVivienda;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TipoAreaViviendaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public $collects = TipoAreaVivienda::class;
        
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($tipoAreaVivienda){
                return [
                    'id' => $tipoAreaVivienda->id,
                    'nombre' => $tipoAreaVivienda->nombre,
                    'factorCirculacionParedes' => $tipoAreaVivienda->factorCirculacionParedes,
                    'factorDireccionTecnica' => $tipoAreaVivienda->factorDireccionTecnica
                ];
            }),          
        ];
    }
}
