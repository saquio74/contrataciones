<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class permisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('permissions')->insert([
            'name'          =>  'Navegar usuarios',
            'slug'          =>  'usuario.navegar',
            'description'   =>  'Listar y navegar los usuarios',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'ver detalles de  usuarios',
            'slug'          =>  'usuario.ver',
            'description'   =>  'detalles de los usuarios',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'editar usuarios',
            'slug'          =>  'usuario.editar',
            'description'   =>  'editar usuarios',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'Eliminar usuarios',
            'slug'          =>  'usuario.borrar',
            'description'   =>  'borrar usuarios',
        ]);
        //roles
        \DB::table('permissions')->insert([
            'name'          =>  'Navegar roles',
            'slug'          =>  'roles.navegar',
            'description'   =>  'Listar y navegar los roles',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'ver detalles de  roles',
            'slug'          =>  'roles.ver',
            'description'   =>  'detalles de los roles',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'crear roles',
            'slug'          =>  'roles.crear',
            'description'   =>  'crear roles',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'editar roles',
            'slug'          =>  'roles.editar',
            'description'   =>  'editar roles',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'Eliminar roles',
            'slug'          =>  'roles.borrar',
            'description'   =>  'borrar roles',
        ]);
        //agentes
        \DB::table('permissions')->insert([
            'name'          =>  'Navegar agente',
            'slug'          =>  'agentes.navegar',
            'description'   =>  'Listar y navegar los agentes',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'ver detalles de  agente',
            'slug'          =>  'agentes.ver',
            'description'   =>  'detalles de los agentes',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'crear agente',
            'slug'          =>  'agentes.crear',
            'description'   =>  'crear agentes',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'editar agente',
            'slug'          =>  'agentes.editar',
            'description'   =>  'editar agentes',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'Eliminar agente',
            'slug'          =>  'agentes.borrar',
            'description'   =>  'borrar agentes',
        ]);
        //vacaciones
        \DB::table('permissions')->insert([
            'name'          =>  'Navegar vacaciones',
            'slug'          =>  'vacaciones.navegar',
            'description'   =>  'Listar y navegar los vacaciones',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'crear vacaciones',
            'slug'          =>  'vacaciones.crear',
            'description'   =>  'crear vacaciones',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'editar vacaciones',
            'slug'          =>  'vacaciones.editar',
            'description'   =>  'editar vacaciones',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'Eliminar vacaciones',
            'slug'          =>  'vacaciones.borrar',
            'description'   =>  'borrar vacaciones',
        ]);
        //libros
        \DB::table('permissions')->insert([
            'name'          =>  'Navegar libros',
            'slug'          =>  'libros.navegar',
            'description'   =>  'Listar y navegar los libros',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'crear libros',
            'slug'          =>  'libros.crear',
            'description'   =>  'crear libros',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'editar libros',
            'slug'          =>  'libros.editar',
            'description'   =>  'editar libros',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'Eliminar libros',
            'slug'          =>  'libros.borrar',
            'description'   =>  'borrar libros',
        ]);
        //contratados
        \DB::table('permissions')->insert([
            'name'          =>  'Navegar contratados',
            'slug'          =>  'contratados.navegar',
            'description'   =>  'Listar y navegar los contratados',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'ver detalles de  contratados',
            'slug'          =>  'contratados.ver',
            'description'   =>  'detalles de los contratados',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'crear contratados',
            'slug'          =>  'contratados.crear',
            'description'   =>  'crear contratados',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'editar contratados',
            'slug'          =>  'contratados.editar',
            'description'   =>  'editar contratados',
        ]);
        \DB::table('permissions')->insert([
            'name'          =>  'Eliminar contratados',
            'slug'          =>  'contratados.borrar',
            'description'   =>  'borrar contratados',
        ]);
    }
}
