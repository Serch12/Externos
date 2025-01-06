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
        Permission::create(['name' => 'vizualizar']);
        Permission::create(['name' => 'editar']);
        Permission::create(['name' => 'eliminar']);

        // Crear roles y asignar permisos
        $admin = Role::create(['name' => 'Root']);
        $admin->givePermissionTo(['vizualizar', 'editar', 'eliminar']);

        // $editor = Role::create(['name' => 'Administrador']);
        // $admin->givePermissionTo(['vizualizar', 'editar', 'eliminar']);
    }
}
