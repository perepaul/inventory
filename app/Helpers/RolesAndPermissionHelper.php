<?php

namespace App\Helpers;

use App\Role;
use App\Permission;

class RolesAndPermissionHelper
{
    public function getAllRoles()
    {
        return Role::all();
    }

    public function getAllPermissions()
    {
        return Permission::all();
    }

    public function getRolePermissions(int $id, $ids_only = false)
    {
        $role = Role::findOrFail($id);
        if ($ids_only) return $role->permissions()->pluck('id');
        return $role->permissions()->get();
    }
}
