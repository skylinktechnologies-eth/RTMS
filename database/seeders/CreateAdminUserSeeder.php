<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
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
        //Admin Seeder
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123')
        ]);

        $role = Role::create(['name' => 'Admin']);
        $waiterRole = Role::create(['name' => 'Waiter']);

        $permissions = Permission::pluck('id','id')->all();

        $waiterPermissions = [
            'order'
        ];
        $waiterRole->givePermissionTo($waiterPermissions);

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
