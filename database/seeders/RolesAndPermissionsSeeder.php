<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Create permissions
                // Permission::create(['name' => 'permission_account_settings']);
                // Permission::create(['name' => 'permission_app_settings']);
                // Permission::create(['name' => 'permission_view']);
                // Permission::create(['name' => 'permission_update']);
                // Permission::create(['name' => 'permission_delete']);
                // Permission::create(['name' => 'permission_create']);

                // Create roles
                // $administrator = Role::create(['name' => 'administrator']);
                // $manager = Role::create(['name' => 'manager']);

                //assign roles to user
                // $administrator= User::where('id',1)->first();
                // $administrator->assignRole('administrator');

                // $manager= User::where('id',2)->first();
                // $manager->assignRole('manager');

                //assign permission to roles

                // $administrator= Role::where('id',1)->first();
                // $administrator->givePermissionTo(['permission_app_settings','permission_account_settings','permission_view','permission_update','permission_delete','permission_create']);
               
                // $manager->givePermissionTo(['permission_view','permission_update']);




    }
}
