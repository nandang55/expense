<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // Transactions
            'transactions.view',
            'transactions.create',
            'transactions.edit',
            'transactions.delete',
            
            // Categories
            'categories.view',
            'categories.create',
            'categories.edit',
            'categories.delete',
            
            // Accounts
            'accounts.view',
            'accounts.create',
            'accounts.edit',
            'accounts.delete',
            
            // Members
            'members.view',
            'members.create',
            'members.edit',
            'members.delete',
            
            // Users
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            
            // Reports
            'reports.account-ledger',
            'reports.calendar-view',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $this->createRoles();
    }

    private function createRoles()
    {
        // Super Admin - All permissions
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $superAdmin->givePermissionTo(Permission::all());

        // Admin - All except user management
        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo([
            'transactions.view',
            'transactions.create',
            'transactions.edit',
            'transactions.delete',
            'categories.view',
            'categories.create',
            'categories.edit',
            'categories.delete',
            'accounts.view',
            'accounts.create',
            'accounts.edit',
            'accounts.delete',
            'members.view',
            'members.create',
            'members.edit',
            'members.delete',
            'reports.account-ledger',
            'reports.calendar-view',
        ]);

        // Manager - View reports, manage transactions
        $manager = Role::create(['name' => 'Manager']);
        $manager->givePermissionTo([
            'transactions.view',
            'transactions.create',
            'transactions.edit',
            'members.view',
            'members.create',
            'members.edit',
            'reports.account-ledger',
            'reports.calendar-view',
        ]);

        // Staff - Create/edit transactions only
        $staff = Role::create(['name' => 'Staff']);
        $staff->givePermissionTo([
            'transactions.view',
            'transactions.create',
            'transactions.edit',
            'members.view',
        ]);

        // Member - Dashboard, transactions view, and reports
        $member = Role::create(['name' => 'Member']);
        $member->givePermissionTo([
            'transactions.view',
            'reports.account-ledger',
            'reports.calendar-view',
        ]);

        // Viewer - Read-only access
        $viewer = Role::create(['name' => 'Viewer']);
        $viewer->givePermissionTo([
            'transactions.view',
            'members.view',
            'reports.calendar-view',
        ]);
    }
}