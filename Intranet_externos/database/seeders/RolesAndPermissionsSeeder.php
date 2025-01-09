<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear permisos
        Permission::create(['name' => 'Crear']);
        Permission::create(['name' => 'Editar']);
        Permission::create(['name' => 'Eliminar']);
        Permission::create(['name' => 'Vizualizar']);

        // Crear roles y asignar permisos
        $admin = Role::create(['name' => 'Root']);
        $admin->givePermissionTo(['Crear', 'Editar', 'Eliminar','Vizualizar']);

        // $editor = Role::create(['name' => 'Administrador']);
        // $admin->givePermissionTo(['vizualizar', 'editar', 'eliminar']);
    }
}
