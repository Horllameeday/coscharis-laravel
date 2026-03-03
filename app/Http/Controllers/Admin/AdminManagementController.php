<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AdminRole;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class AdminManagementController extends Controller
{
    /**
     * List all admin users with their roles.
     */
    public function index()
    {
        $admins = AdminUser::role(AdminRole::values(), 'sanctum')
            ->with('roles')
            ->get()
            ->map(fn($admin) => [
                'id'        => $admin->id,
                'full_name' => $admin->fullName(),
                'email'     => $admin->email,
                'status'    => $admin->status,
                'roles'     => $admin->getRoleNames(),
            ]);

        return $this->response(Response::HTTP_OK, 'Admins fetched', $admins);
    }

    /**
     * Create a new admin user and assign a role.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|email|unique:users,email',
            'phone_number' => 'required|unique:users,phone_number',
            'password'     => 'required|string|min:8|confirmed',
            'role'         => ['required', Rule::in(AdminRole::values())],
        ]);

        try {
            $admin = AdminUser::create($data);
            $admin->assignRole($data['role']);

            Log::info('Admin created', [
                'admin_id'   => $admin->id,
                'role'       => $data['role'],
                'created_by' => $request->user()->id,
            ]);

            return $this->response(Response::HTTP_CREATED, 'Admin created successfully', [
                'id'        => $admin->id,
                'full_name' => $admin->fullName(),
                'email'     => $admin->email,
                'roles'     => $admin->getRoleNames(),
            ]);
        } catch (Exception $e) {
            Log::error('Admin creation failed', ['exception' => $e->getMessage()]);

            return $this->response(Response::HTTP_INTERNAL_SERVER_ERROR, 'Admin creation failed');
        }
    }

    /**
     * Update an admin's role.
     */
    public function updateRole(Request $request, string $id)
    {
        $data = $request->validate([
            'role' => ['required', Rule::in(AdminRole::values())],
        ]);

        try {
            $admin = AdminUser::findOrFail($id);

            // Prevent demoting the last super-admin
            if (
                $admin->hasRole(AdminRole::SUPER_ADMIN->value) &&
                AdminUser::role(AdminRole::SUPER_ADMIN->value, 'sanctum')->count() === 1
            ) {
                return $this->response(
                    Response::HTTP_UNPROCESSABLE_ENTITY,
                    'Cannot change the role of the last super-admin'
                );
            }

            $admin->syncRoles([$data['role']]);

            Log::info('Admin role updated', [
                'admin_id'   => $admin->id,
                'new_role'   => $data['role'],
                'updated_by' => $request->user()->id,
            ]);

            return $this->response(Response::HTTP_OK, 'Role updated', [
                'id'    => $admin->id,
                'roles' => $admin->getRoleNames(),
            ]);
        } catch (Exception $e) {
            Log::error('Admin role update failed', ['exception' => $e->getMessage()]);

            return $this->response(Response::HTTP_INTERNAL_SERVER_ERROR, 'Role update failed');
        }
    }

    /**
     * Disable an admin account.
     */
    public function disable(Request $request, string $id)
    {
        try {
            $admin = AdminUser::findOrFail($id);

            if ($admin->id === $request->user()->id) {
                return $this->response(
                    Response::HTTP_UNPROCESSABLE_ENTITY,
                    'You cannot disable your own account'
                );
            }

            $admin->update(['status' => \App\Enums\UserProfileStatus::DISABLED]);

            Log::info('Admin disabled', [
                'admin_id'    => $admin->id,
                'disabled_by' => $request->user()->id,
            ]);

            return $this->response(Response::HTTP_OK, 'Admin disabled');
        } catch (Exception $e) {
            return $this->response(Response::HTTP_INTERNAL_SERVER_ERROR, 'Failed to disable admin');
        }
    }
}
