<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Clear permission cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Define all permissions with consistent naming
        $permissions = [
            // Users
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',
            'ban-users',
            'assign-roles',        // Superadmin only
            'impersonate-users',   // Superadmin only

            // Roles & Permissions (Superadmin only)
            'manage-roles',
            'manage-permissions',

            // Blog
            'view-blog',
            'create-blog',
            'edit-blog',
            'delete-blog',
            'manage-blog-categories',

            // News
            'view-news',
            'create-news',
            'edit-news',
            'delete-news',

            // Pages
            'view-pages',
            'create-pages',
            'edit-pages',
            'delete-pages',

            // Help Center
            'view-help-center',

            // Products
            'view-products',
            'create-products',
            'edit-products',
            'delete-products',
            'manage-product-categories',
            'import-products',

            // Orders
            'view-orders',
            'edit-orders',
            'verify-orders',
            'refund-orders',

            // Payment Methods
            'view-payment-methods',
            'manage-payment-methods',

            // Credit Logs
            'view-credit-logs',
            'create-credit-logs',  // Superadmin only (high risk)

            // Tickets
            'view-tickets',
            'reply-tickets',
            'manage-tickets',

            // Referrals
            'view-referrals',
            'view-commissions',

            // Withdrawals
            'view-withdrawals',
            'process-withdrawals',

            // Settings (Superadmin only)
            'manage-settings',
        ];

        // Create all permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles
        $superadminRole = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $userRole = Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);
        $demoRole = Role::firstOrCreate(['name' => 'demo', 'guard_name' => 'web']);

        // Superadmin: NO permissions assigned (uses Gate::before bypass)
        // Clear any existing permissions
        $superadminRole->syncPermissions([]);

        // Admin: All permissions EXCEPT superadmin-only ones
        $superadminOnlyPermissions = [
            'manage-roles',
            'manage-permissions',
            'manage-settings',
            'assign-roles',
            'impersonate-users',
            'create-credit-logs',
        ];

        $adminPermissions = Permission::whereNotIn('name', $superadminOnlyPermissions)->get();
        $adminRole->syncPermissions($adminPermissions);

        // User role: No admin permissions
        $userRole->syncPermissions([]);

        // Assign roles to default users
        $this->assignDefaultRoles();
    }

    private function assignDefaultRoles(): void
    {
        // User ID 1 = Superadmin
        $superadmin = User::find(1);
        if ($superadmin) {
            $superadmin->syncRoles(['superadmin']);
        }

        // User ID 2 = Admin
        $admin = User::find(2);
        if ($admin) {
            $admin->syncRoles(['admin']);
        }

        // User ID 3 = Regular User
        $user = User::find(3);
        if ($user) {
            $user->syncRoles(['user']);
        }
        
        // User ID 4 = Demo User
        $demo = User::find(4);
        if ($demo) {
            $demo->syncRoles(['demo']);
        }
    }
}
