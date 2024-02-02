<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            
            'user-list',
            'user-create',
            'user-edit',
            'user-delete', 
            
            'menuCategory-list',
            'menuCategory-create',
            'menuCategory-edit',
            'menuCategory-delete',
            
            'issuing-list',
            'issuing-create',
            'issuing-edit',
            'issuing-delete',

            'supplyItemCategory-list',
            'supplyItemCategory-create',
            'supplyItemCategory-edit',
            'supplyItemCategory-delete',
            
            'location-list',
            'location-create',
            'location-edit',
            'location-delete',

            'menuItem-list',
            'menuItem-create',
            'menuItem-edit',
            'menuItem-delete',

            'order-list',
            'order-create',
            'order-edit',
            'order-delete',

            'purchase-list',
            'purchase-create',
            'purchase-edit',
            'purchase-delete',

           'report-manage',

            'reservation-list',
            'reservation-create',
            'reservation-edit',
            'reservation-delete',


            'supplier-list',
            'supplier-create',
            'supplier-edit',
            'supplier-delete',

            'supplyItem-list',
            'supplyItem-create',
            'supplyItem-edit',
            'supplyItem-delete',

            'table-list',
            'table-create',
            'table-edit',
            'table-delete',

            'waitstaff-list',
            'waitstaff-create',
            'waitstaff-edit',
            'waitstaff-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
'
            kitchen-list',
           
        ];
       
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}