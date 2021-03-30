<?php

use App\Ambiente;
use App\AreaVivienda;
use App\Proyecto;
use App\TipoAcabado;
use Illuminate\Database\Seeder;
use App\TipoAreaVivienda;
use App\Ubicacion;
use App\User;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {                
        $role1 = Role::create(['name' => 'Administrador']);
        $role2 = Role::create(['name' => 'Planificador']);
        $role3 = Role::create(['name' => 'Escritor']);

        Permission::create(['name' => 'tipoAreaVivienda.all'])->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name' => 'tipoAreaVivienda.create'])->syncRoles([$role1, $role2, $role3]); 
        Permission::create(['name' => 'tipoAreaVivienda.edit'])->syncRoles([$role1, $role2,$role3]); 
        Permission::create(['name' => 'tipoAreaVivienda.destroy'])->syncRoles([$role1, $role2,$role3]); 

               
        $user= new User();
        $user->name="Diana Morocho";
        $user->email="mor8diana@wetch.com";
        $user->password=Hash::make("Mdiana1105");        
        $user->save();

        $user->assignRole('Administrador');
        $user->assignRole('Planificador');

        $tipo_min = new TipoAreaVivienda();
        $tipo_min->nombre = "Normal";
        $tipo_min->factorCirculacionParedes  = 0.15;
        $tipo_min->factorDireccionTecnica  = 0.10;
        $tipo_min->propietario = $user->id;
        $tipo_min->save();

        $tipo_min = new TipoAreaVivienda();
        $tipo_min->nombre = "Lujo";
        $tipo_min->factorCirculacionParedes  = 0.15;
        $tipo_min->factorDireccionTecnica  = 0.10;
        $tipo_min->propietario = $user->id;
        $tipo_min->save();

        
        $tipo_min = new TipoAreaVivienda();
        $tipo_min->nombre = "Mínima";
        $tipo_min->factorCirculacionParedes  = 0.15;
        $tipo_min->factorDireccionTecnica  = 0.10;
        $tipo_min->propietario = $user->id;
        $tipo_min->save();

        
        $tipo_min = new TipoAreaVivienda();
        $tipo_min->nombre = "Grande";
        $tipo_min->factorCirculacionParedes  = 0.15;
        $tipo_min->factorDireccionTecnica  = 0.10;
        $tipo_min->propietario = $user->id;
        $tipo_min->save();
        
        $ambiente_a = new Ambiente();
        $ambiente_a->nombre = "Sala";
        $ambiente_a->descripcion = "Sala de estar";
        $ambiente_a->propietario = $user->id;
        $ambiente_a->save();

        $ambiente_b = new Ambiente();
        $ambiente_b->nombre = "Cuarto de lavado";
        $ambiente_b->descripcion = "Cuarto de lavado";
        $ambiente_b->propietario = $user->id;
        $ambiente_b->save();
        
        $ambiente_c = new Ambiente();
        $ambiente_c->nombre = "Area de secado";
        $ambiente_c->descripcion = "Area de secado";
        $ambiente_c->propietario = $user->id;
        $ambiente_c->save();

        $acabado_a = new TipoAcabado();
        $acabado_a->nombre = "Lujo";
        $acabado_a->costoAcabadoVivienda = 23.3;
        $acabado_a->propietario = $user->id;
        $acabado_a->save();

        $acabado_b = new TipoAcabado();
        $acabado_b->nombre = "Primera Calidad";
        $acabado_b->costoAcabadoVivienda = 24.3;
        $acabado_b->propietario = $user->id;
        $acabado_b->save();

        $acabado_c = new TipoAcabado();
        $acabado_c->nombre = "Segunda Calidad";
        $acabado_c->costoAcabadoVivienda = 25.3;
        $acabado_c->propietario = $user->id;
        $acabado_c->save();

        $ubicacion= new Ubicacion();
        $ubicacion->provincia = "Loja";
        $ubicacion->canton = "Loja";
        $ubicacion->sector = "El Valle";
        $ubicacion->propietario = $user->id;
        $ubicacion->save();

        $proyecto = new Proyecto();
        $proyecto->titulo = "Proyecto Prueba";
        $proyecto->fecha = date("Y-m-d");
        $proyecto->User_id = $user->id;
        $proyecto->ubicacion_id = $ubicacion->id;        
        $proyecto->save();

        factory(App\AreaVivienda::class, 10)->create();
        factory(App\AreaConstruccion::class, 5)->create();
        factory(App\Prefactibilidad::class, 5)->create();
        factory(App\ItemPrefactibilidad::class, 20)->create();

    
    }
}
