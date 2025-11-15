<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //crear permisos
        $permVerGraficas = Permission::create(['name' => 'ver graficas']);
        $permVotar = Permission::create(['name' => 'votar']);
        $permGenerarClaves = Permission::create(['name' => 'generar claves']);
        
        //crear roles
        $roleUser= Role::create(['name' => 'usuario_normal']);
        $roleAdmin = Role::create(['name' => 'admin']);


        //asignar permisos a roles
        $roleAdmin->syncPermissions($permVerGraficas);
        $roleUser->syncPermissions ([$permVotar,$permGenerarClaves]);
 

        //crear un usuario normal
        $userNormal = User::query()->create([
            'name' => 'leonardo',
            'last_name1' => 'chagoya',
            'last_name2' => 'gonzalez',
            'user_name' => 'chagoya27',
            'email' => 'chagoya27@gmail.com',
            //laravel utiliza por defecto bcrypt
            'password' => Hash::make('password')   //hash('sha3-256', 'password')
        ]);

        //crear usuario administrador
        $adminUser = User::query()->create([
            'name' => 'admin',
            'last_name1' => 'admin_lastname1',
            'last_name2' => 'admin_lastname2',
            'user_name' => 'admin123',
            'email' => 'admin123@gmail.com',
            //laravel utiliza por defecto bcrypt
            'password' => Hash::make('password')   //hash('sha3-256', 'password')
        ]);

    


        //asignamos roles a usuarios
        $adminUser->assignRole($roleAdmin);
        $userNormal->assignRole($roleUser);
      
    }
}
