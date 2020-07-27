<?php

use Illuminate\Database\Seeder;
use caffeinated\Shinobi\Models\Permission;

class permisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name'          =>  'Navegar usuarios',
            'slug'          =>  'users.index',
            'description'   =>  'Listar y navegar los usuarios',
        ]);
        Permission::create([
            'name'          =>  'ver detalles de  usuarios',
            'slug'          =>  'users.show',
            'description'   =>  'detalles de los usuarios',
        ]);
        Permission::create([
            'name'          =>  'editar usuarios',
            'slug'          =>  'users.edit',
            'description'   =>  'editar usuarios',
        ]);
        Permission::create([
            'name'          =>  'Eliminar usuarios',
            'slug'          =>  'users.destroy',
            'description'   =>  'borrar usuarios',
        ]);
        //roles
        Permission::create([
            'name'          =>  'Navegar roles',
            'slug'          =>  'users.index',
            'description'   =>  'Listar y navegar los roles',
        ]);
        Permission::create([
            'name'          =>  'ver detalles de  roles',
            'slug'          =>  'users.show',
            'description'   =>  'detalles de los roles',
        ]);
        Permission::create([
            'name'          =>  'crear roles',
            'slug'          =>  'users.create',
            'description'   =>  'crear roles',
        ]);
        Permission::create([
            'name'          =>  'editar roles',
            'slug'          =>  'users.edit',
            'description'   =>  'editar roles',
        ]);
        Permission::create([
            'name'          =>  'Eliminar roles',
            'slug'          =>  'roles.destroy',
            'description'   =>  'borrar roles',
        ]);
    }
}
