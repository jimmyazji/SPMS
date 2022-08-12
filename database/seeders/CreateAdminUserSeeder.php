<?php

namespace Database\Seeders;

use App\Enums\Specialization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'first_name' => 'Ibrahem',
            'last_name' => 'Alnasser',
            'stdsn' => '4160067',
            'email' => 'ibrahemalnasser3@gmail.com',
            'spec' => Specialization::Software,
            'password' => bcrypt('12345678'),
        ]);

        Role::create(['name' => 'Student']);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
