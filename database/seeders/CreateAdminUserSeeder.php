<?php

namespace Database\Seeders;

use App\Models\Dept;
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
            'first_name' => 'Jimmy',
            'last_name' =>'Yazji',
            'stdsn' => '4160067',
            'email' => 'jimmy@gmail.com',
            'avatar' => 'jimmy.jpg',
            'password' => bcrypt('12345678'),
            'dept_id' => Dept::create(['name'=>'Adminstration'])->id,
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
