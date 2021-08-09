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

        // Create default permissions
        Permission::create(['name' => 'list periods']);
        Permission::create(['name' => 'view periods']);
        Permission::create(['name' => 'create periods']);
        Permission::create(['name' => 'update periods']);
        Permission::create(['name' => 'delete periods']);

        Permission::create(['name' => 'list courses']);
        Permission::create(['name' => 'view courses']);
        Permission::create(['name' => 'create courses']);
        Permission::create(['name' => 'update courses']);
        Permission::create(['name' => 'delete courses']);

        Permission::create(['name' => 'list matters']);
        Permission::create(['name' => 'view matters']);
        Permission::create(['name' => 'create matters']);
        Permission::create(['name' => 'update matters']);
        Permission::create(['name' => 'delete matters']);

        Permission::create(['name' => 'list admissions']);
        Permission::create(['name' => 'view admissions']);
        Permission::create(['name' => 'create admissions']);
        Permission::create(['name' => 'update admissions']);
        Permission::create(['name' => 'delete admissions']);

        Permission::create(['name' => 'list schools']);
        Permission::create(['name' => 'view schools']);
        Permission::create(['name' => 'create schools']);
        Permission::create(['name' => 'update schools']);
        Permission::create(['name' => 'delete schools']);

        Permission::create(['name' => 'list mallas']);
        Permission::create(['name' => 'view mallas']);
        Permission::create(['name' => 'create mallas']);
        Permission::create(['name' => 'update mallas']);
        Permission::create(['name' => 'delete mallas']);

        Permission::create(['name' => 'list careers']);
        Permission::create(['name' => 'view careers']);
        Permission::create(['name' => 'create careers']);
        Permission::create(['name' => 'update careers']);
        Permission::create(['name' => 'delete careers']);

        Permission::create(['name' => 'list courseclasstasks']);
        Permission::create(['name' => 'view courseclasstasks']);
        Permission::create(['name' => 'create courseclasstasks']);
        Permission::create(['name' => 'update courseclasstasks']);
        Permission::create(['name' => 'delete courseclasstasks']);

        Permission::create(['name' => 'list courseclasses']);
        Permission::create(['name' => 'view courseclasses']);
        Permission::create(['name' => 'create courseclasses']);
        Permission::create(['name' => 'update courseclasses']);
        Permission::create(['name' => 'delete courseclasses']);

        Permission::create(['name' => 'list levels']);
        Permission::create(['name' => 'view levels']);
        Permission::create(['name' => 'create levels']);
        Permission::create(['name' => 'update levels']);
        Permission::create(['name' => 'delete levels']);

        Permission::create(['name' => 'list classcomments']);
        Permission::create(['name' => 'view classcomments']);
        Permission::create(['name' => 'create classcomments']);
        Permission::create(['name' => 'update classcomments']);
        Permission::create(['name' => 'delete classcomments']);

        Permission::create(['name' => 'list allassistances']);
        Permission::create(['name' => 'view allassistances']);
        Permission::create(['name' => 'create allassistances']);
        Permission::create(['name' => 'update allassistances']);
        Permission::create(['name' => 'delete allassistances']);

        Permission::create(['name' => 'list admissionataches']);
        Permission::create(['name' => 'view admissionataches']);
        Permission::create(['name' => 'create admissionataches']);
        Permission::create(['name' => 'update admissionataches']);
        Permission::create(['name' => 'delete admissionataches']);

        Permission::create(['name' => 'list studenttasks']);
        Permission::create(['name' => 'view studenttasks']);
        Permission::create(['name' => 'create studenttasks']);
        Permission::create(['name' => 'update studenttasks']);
        Permission::create(['name' => 'delete studenttasks']);

        Permission::create(['name' => 'list studenttaskattaches']);
        Permission::create(['name' => 'view studenttaskattaches']);
        Permission::create(['name' => 'create studenttaskattaches']);
        Permission::create(['name' => 'update studenttaskattaches']);
        Permission::create(['name' => 'delete studenttaskattaches']);

        Permission::create(['name' => 'list comments']);
        Permission::create(['name' => 'view comments']);
        Permission::create(['name' => 'create comments']);
        Permission::create(['name' => 'update comments']);
        Permission::create(['name' => 'delete comments']);

        Permission::create(['name' => 'list enrollments']);
        Permission::create(['name' => 'view enrollments']);
        Permission::create(['name' => 'create enrollments']);
        Permission::create(['name' => 'update enrollments']);
        Permission::create(['name' => 'delete enrollments']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
