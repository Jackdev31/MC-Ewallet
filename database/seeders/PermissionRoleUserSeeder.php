<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class PermissionRoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define permissions
        $permissions = [
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',
            'view users',
            'create users',
            'edit users',
            'delete users',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // Define roles and their permissions
        $roles = [
            'permission roles' => [
                'view permissions',
                'create permissions',
                'edit permissions',
                'delete permissions',
            ],
            'role roles' => [
                'view roles',
                'create roles',
                'edit roles',
                'delete roles',
            ],
            'user roles' => [
                'view users',
                'create users',
                'edit users',
                'delete users',
            ],
            'superadmin' => [], // will get all via Gate::before
        ];

        foreach ($roles as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            if (!empty($perms)) {
                $role->syncPermissions($perms);
            }
        }

        // Create Super Admin user
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('secret123'),
            ]
        );

        // Assign Super Admin role
        $superAdmin->assignRole('superadmin');
    }
}
