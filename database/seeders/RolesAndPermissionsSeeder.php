<?php

namespace Database\Seeders;

use App\Enums\AdminRole;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles & permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (AdminRole::values() as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'sanctum']);
        }

        $this->command->info('Admin roles created: ' . implode(', ', AdminRole::values()));

        // Create a default super-admin if one doesn't already exist
        $superAdminEmail = env('SUPER_ADMIN_EMAIL', 'superadmin@coscharis.com');

        if (!User::where('email', $superAdminEmail)->exists()) {
            $admin = User::create([
                'id'           => Str::uuid(),
                'first_name'   => 'Super',
                'last_name'    => 'Admin',
                'email'        => $superAdminEmail,
                'phone_number' => env('SUPER_ADMIN_PHONE', '08000000000'),
                'password'     => env('SUPER_ADMIN_PASSWORD', 'changeme123'),
            ]);

            $admin->assignRole(AdminRole::SUPER_ADMIN->value);

            $this->command->info("Super-admin created: {$superAdminEmail}");
        } else {
            $this->command->info('Super-admin already exists — skipping.');
        }
    }
}
