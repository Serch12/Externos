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
    public function run() {

        // Lista de permisos a agregar
        $newPermissions = [
            'Crear',
            'Editar',
            'Eliminar',
            'Vizualizar',
            'Permisos',
        ];

        // Crear permisos si no existen
        foreach ($newPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Asignar todos los permisos al rol "Root"
        $admin = Role::where('name', 'Root')->first();

        if ($admin) {
            $admin->syncPermissions($newPermissions); // Sincroniza permisos sin duplicar
        } else {
            // Si el rol "Root" no existe, puedes crearlo y asignarle permisos
            $admin = Role::create(['name' => 'Root']);
            $admin->syncPermissions($newPermissions);
        }

    }
}
