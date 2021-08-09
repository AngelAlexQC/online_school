<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create user role and assign existing permissions
        $currentPermissions = [
            Permission::firstOrCreate(['name' => 'list periods']),
            Permission::firstOrCreate(['name' => 'view periods']),
            Permission::firstOrCreate(['name' => 'list matters']),
            Permission::firstOrCreate(['name' => 'view matters']),
            Permission::firstOrCreate(['name' => 'create admissions']),
            Permission::firstOrCreate(['name' => 'list schools']),
            Permission::firstOrCreate(['name' => 'view schools']),
            Permission::firstOrCreate(['name' => 'list mallas']),
            Permission::firstOrCreate(['name' => 'view mallas']),
            Permission::firstOrCreate(['name' => 'list careers']),
            Permission::firstOrCreate(['name' => 'view careers']),
            Permission::firstOrCreate(['name' => 'list levels']),
            Permission::firstOrCreate(['name' => 'view levels']),
            Permission::firstOrCreate(['name' => 'list admissionataches']),
            Permission::firstOrCreate(['name' => 'view admissionataches']),
            Permission::firstOrCreate(['name' => 'create admissionataches']),
            Permission::firstOrCreate(['name' => 'update admissionataches']),
            Permission::firstOrCreate(['name' => 'delete admissionataches']),
            Permission::firstOrCreate(['name' => 'list comments']),
            Permission::firstOrCreate(['name' => 'view comments']),
            Permission::firstOrCreate(['name' => 'create comments']),
        ];
        $userRole = Role::firstOrCreate(['name' => 'Requester']);
        $userRole->givePermissionTo($currentPermissions);

        // Create default permissions

        Permission::firstOrCreate(['name' => 'create periods']);
        Permission::firstOrCreate(['name' => 'update periods']);
        Permission::firstOrCreate(['name' => 'delete periods']);

        Permission::firstOrCreate(['name' => 'list courses']);
        Permission::firstOrCreate(['name' => 'view courses']);
        Permission::firstOrCreate(['name' => 'create courses']);
        Permission::firstOrCreate(['name' => 'update courses']);
        Permission::firstOrCreate(['name' => 'delete courses']);


        Permission::firstOrCreate(['name' => 'create matters']);
        Permission::firstOrCreate(['name' => 'update matters']);
        Permission::firstOrCreate(['name' => 'delete matters']);

        Permission::firstOrCreate(['name' => 'list admissions']);
        Permission::firstOrCreate(['name' => 'view admissions']);
        Permission::firstOrCreate(['name' => 'update admissions']);
        Permission::firstOrCreate(['name' => 'delete admissions']);


        Permission::firstOrCreate(['name' => 'create schools']);
        Permission::firstOrCreate(['name' => 'update schools']);
        Permission::firstOrCreate(['name' => 'delete schools']);


        Permission::firstOrCreate(['name' => 'create mallas']);
        Permission::firstOrCreate(['name' => 'update mallas']);
        Permission::firstOrCreate(['name' => 'delete mallas']);


        Permission::firstOrCreate(['name' => 'create careers']);
        Permission::firstOrCreate(['name' => 'update careers']);
        Permission::firstOrCreate(['name' => 'delete careers']);

        Permission::firstOrCreate(['name' => 'list courseclasstasks']);
        Permission::firstOrCreate(['name' => 'view courseclasstasks']);
        Permission::firstOrCreate(['name' => 'create courseclasstasks']);
        Permission::firstOrCreate(['name' => 'update courseclasstasks']);
        Permission::firstOrCreate(['name' => 'delete courseclasstasks']);

        Permission::firstOrCreate(['name' => 'list courseclasses']);
        Permission::firstOrCreate(['name' => 'view courseclasses']);
        Permission::firstOrCreate(['name' => 'create courseclasses']);
        Permission::firstOrCreate(['name' => 'update courseclasses']);
        Permission::firstOrCreate(['name' => 'delete courseclasses']);


        Permission::firstOrCreate(['name' => 'create levels']);
        Permission::firstOrCreate(['name' => 'update levels']);
        Permission::firstOrCreate(['name' => 'delete levels']);

        Permission::firstOrCreate(['name' => 'list classcomments']);
        Permission::firstOrCreate(['name' => 'view classcomments']);
        Permission::firstOrCreate(['name' => 'create classcomments']);
        Permission::firstOrCreate(['name' => 'update classcomments']);
        Permission::firstOrCreate(['name' => 'delete classcomments']);

        Permission::firstOrCreate(['name' => 'list allassistances']);
        Permission::firstOrCreate(['name' => 'view allassistances']);
        Permission::firstOrCreate(['name' => 'create allassistances']);
        Permission::firstOrCreate(['name' => 'update allassistances']);
        Permission::firstOrCreate(['name' => 'delete allassistances']);

        Permission::firstOrCreate(['name' => 'list studenttasks']);
        Permission::firstOrCreate(['name' => 'view studenttasks']);
        Permission::firstOrCreate(['name' => 'create studenttasks']);
        Permission::firstOrCreate(['name' => 'update studenttasks']);
        Permission::firstOrCreate(['name' => 'delete studenttasks']);

        Permission::firstOrCreate(['name' => 'list studenttaskattaches']);
        Permission::firstOrCreate(['name' => 'view studenttaskattaches']);
        Permission::firstOrCreate(['name' => 'create studenttaskattaches']);
        Permission::firstOrCreate(['name' => 'update studenttaskattaches']);
        Permission::firstOrCreate(['name' => 'delete studenttaskattaches']);


        Permission::firstOrCreate(['name' => 'update comments']);
        Permission::firstOrCreate(['name' => 'delete comments']);

        Permission::firstOrCreate(['name' => 'list enrollments']);
        Permission::firstOrCreate(['name' => 'view enrollments']);
        Permission::firstOrCreate(['name' => 'create enrollments']);
        Permission::firstOrCreate(['name' => 'update enrollments']);
        Permission::firstOrCreate(['name' => 'delete enrollments']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::firstOrCreate(['name' => 'list roles']);
        Permission::firstOrCreate(['name' => 'view roles']);
        Permission::firstOrCreate(['name' => 'create roles']);
        Permission::firstOrCreate(['name' => 'update roles']);
        Permission::firstOrCreate(['name' => 'delete roles']);

        Permission::firstOrCreate(['name' => 'list permissions']);
        Permission::firstOrCreate(['name' => 'view permissions']);
        Permission::firstOrCreate(['name' => 'create permissions']);
        Permission::firstOrCreate(['name' => 'update permissions']);
        Permission::firstOrCreate(['name' => 'delete permissions']);

        Permission::firstOrCreate(['name' => 'list users']);
        Permission::firstOrCreate(['name' => 'view users']);
        Permission::firstOrCreate(['name' => 'create users']);
        Permission::firstOrCreate(['name' => 'update users']);
        Permission::firstOrCreate(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
