<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoAreaViviendaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'factorCirculacionParedes' => $this->factorCirculacionParedes,
            'factorDireccionTecnica' => $this->factorDireccionTecnica            
        ];
    }
}
