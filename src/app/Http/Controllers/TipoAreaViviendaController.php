<?php

namespace App\Http\Controllers;

use App\Http\Resources\TipoAreaVivienda;
use App\Http\Resources\TipoAreaViviendaCollection;
use App\Http\Resources\TipoAreaViviendaResource;
use App\TipoAreaVivienda as TAreaVivienda;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoAreaViviendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    {                                
        //FALTA IMPLEMENTAR TODO EL REPOSITORIO
        if($request->user()->can('tipoAreaVivienda.all')){            
            if ($request->repositorio){
                //query para obtener id nombre y rol de todos los usuarios
                // SELECT u.id, u.name, r.name FROM `users` u INNER JOIN `model_has_roles` mr ON u.`id` = mr.`model_id` INNER JOIN `roles` r ON mr.role_id = r.id WHERE r.name = 'Planificador'                
                $users_ids = DB::select('SELECT u.id FROM users u INNER JOIN model_has_roles mr ON u.id = mr.model_id INNER JOIN roles r ON mr.role_id = r.id WHERE r.name = ?', ['Escritor']);
                $users_ids = array_map(function ($value) {
                    return (array)$value;
                }, $users_ids);
                //Query que devuelve todos los tipos de área de Vivienda del repositorio
                return new TipoAreaViviendaCollection(TAreaVivienda::where('propietario',$users_ids)->get());
            }else{
                //Query que devuelve todos los tipos de área de vivienda propios de un Planificador
                return new TipoAreaViviendaCollection(TAreaVivienda::where('propietario',$request->user()->id)->get());
            }            
        }else{
            return response()->json([
                'message' => 'Acceso no autorizado'
            ], 401);
        }                
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:100',
            'factorCirculacionParedes' => 'required|numeric|min:0.1|max:9999.99',
            'factorDireccionTecnica' => 'required|numeric|min:0.1|max:9999.99',            
        ]);

        $tipoAreaVivienda = TAreaVivienda::create([
            'nombre' => $validatedData['nombre'],
            'factorCirculacionParedes' => $validatedData['factorCirculacionParedes'],
            'factorDireccionTecnica' => $validatedData['factorDireccionTecnica'],
            'propietario' => $request->user()->id,
        ]);

        if($tipoAreaVivienda){
            return response()->json([
                'message' => 'Agregado con éxito'                
            ], 201);
        }else{
            return response()->json([
                'message' => 'Se produjo un error en el proceso de guardado'                
            ], 400);
        }        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TipoAreaVivienda  $tipoAreaVivienda
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {                                
        if ($request->repositorio){
            //Vista de un tipo de área de vivienda cuando se observa desde el repositorio
            $users_ids = DB::select('SELECT u.id FROM users u INNER JOIN model_has_roles mr ON u.id = mr.model_id INNER JOIN roles r ON mr.role_id = r.id WHERE r.name = ?', ['Escritor']);
            $users_ids = array_map(function ($value) {
                return (array)$value;
            }, $users_ids);
            return new TipoAreaViviendaResource(TAreaVivienda::where('propietario',$users_ids)->findOrFail($id));            
        }else{
            //Vista de un tipo de área de vivienda cuando es el propietario del registro
            return new TipoAreaViviendaResource(TAreaVivienda::where('propietario',$request->user()->id)->findOrFail($id));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipoAreaVivienda  $tipoAreaVivienda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TAreaVivienda $tipoAreaVivienda)
    {
        if($request->user()->id != $tipoAreaVivienda->propietario){
            return response()->json([
                'message' => 'No autorizado'                
            ], 401);
        }
        
        $validatedData = $request->validate([
            'nombre' => 'string|max:100',
            'factorCirculacionParedes' => 'required|numeric|min:0.1|max:9999.99',
            'factorDireccionTecnica' => 'required|numeric|min:0.1|max:9999.99'
        ]);        

        $tipoAreaVivienda->update(
            ['nombre' => $validatedData['nombre'],
            'factorCirculacionParedes' => $validatedData['factorCirculacionParedes'],
            'factorDireccionTecnica' => $validatedData['factorDireccionTecnica'],
            ]
        );
        // $tipoAreaVivienda->update($request->all());
        return response(new TipoAreaViviendaResource($tipoAreaVivienda), 201);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipoAreaVivienda  $tipoAreaVivienda
     * @return \Illuminate\Http\Response
     */
    public function destroy(TAreaVivienda $tipoAreaVivienda, Request $request)
    {
        
        if($request->user()->id != $tipoAreaVivienda->propietario){            
            return response()->json([
                'message' => 'No autorizado'                
            ], 401);
        }

        $tipoAreaVivienda->delete();
        return response()->json([
            'message' => 'Eliminado con éxito'                
        ], 204);
    }
}
