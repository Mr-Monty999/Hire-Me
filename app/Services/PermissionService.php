<?php

namespace App\Services;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionService.
 */
class PermissionService
{

    public static function insert($permissions)
    {
        $permission = Permission::insert($permissions);
        return $permission;
    }
    public static function delete($permissionName)
    {
        $permission = Permission::where("name", "=", $permissionName);
        $permission->delete();
        return $permission;
    }
    public static function update($permissionName, $permissionNewName)
    {
        $permission = Permission::where("name", "=", $permissionName);
        $permission->update(["name" => $permissionNewName]);
        return $permission;
    }
    public static function exists($permissionName)
    {
        $permission = Permission::where("name", "=", $permissionName);
        return $permission->exists();
    }
}
