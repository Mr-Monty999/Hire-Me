<?php

namespace App\Services;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class RoleService.
 */
class RoleService
{


    public static function insert($roles)
    {

        $role = Role::insert($roles);
        return $role;
    }

    public static function delete($roleName)
    {
        $role = Role::where("name", "=", $roleName);
        $role->delete();
        return $role;
    }
    public static function update($roleName, $roleNewName)
    {
        $role = Role::where("name", "=", $roleName);
        $role->update(["name" => $roleNewName]);
        return $role;
    }
    public static function exists($roleName)
    {
        $role = Role::where("name", "=", $roleName);
        return $role->exists();
    }
}
