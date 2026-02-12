<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'products-view',
            'products-create',
            'products-update',
            'products-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles dan assign permissions

        // Admin ada all permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Staff hanya boleh view, create, update
        $staffRole = Role::create(['name' => 'staff']);
        $staffRole->givePermissionTo([
            'products-view',
            'products-create',
            'products-update'
        ]);

        // Viewer hanya boleh view only
        $viewerRole = Role::create(['name' => 'viewer']);
        $viewerRole->givePermissionTo('products-view');
    }
}