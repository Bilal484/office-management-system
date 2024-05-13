<?php

namespace App\Repositories\Eloquents;

use App\PermissionRole;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\IPermissionRoleRepository;

class PermissionRoleRepository implements IPermissionRoleRepository
{
    protected $permissionRoles;

    public function __construct(PermissionRole $permissionRoles)
    {
        $this->permissionRoles = $permissionRoles;
    }

    public function store(Request $request, $role_id)
    {
        $permission_role = $this->permissionRoles->create([
            'role_id' => $role_id,
            'permission_id' => $request->permission
        ]);

        return [
            'result' => $permission_role !== null,
            'permission_role' => $permission_role
        ];
    }

    public function destroy($id)
    {
        $permission_role = $this->permissionRoles->where('role_id', $id)->first();

        if (!$permission_role) {
            return [
                'result' => false
            ];
        }

        return [
            'result' => $permission_role->delete()
        ];
    }
}
