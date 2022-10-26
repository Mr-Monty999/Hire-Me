<?php

namespace App\Services;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionService.
 */
class PermissionService
{

    public static function create($permissionName)
    {
        $permission = Permission::create(["name" => $permissionName]);
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

    public static function userPermissions()
    {
        return [
            "create-users",
            // "view-users",
            "edit-users",
            "delete-users",
            "view-profiles",
            "edit-profiles",
            "create-posts",
            "view-posts",
            "edit-posts",
            "delete-posts",
            "create-jobs",
            "view-jobs",
            "edit-jobs",
            "delete-jobs",
            "create-skills",
            "view-skills",
            "edit-skills",
            "delete-skills",
            "create-users-phones",
            "view-users-phones",
            "edit-users-phones",
            "delete-users-phones",
            "create-experiences",
            "view-experiences",
            "edit-experiences",
            "delete-experiences",
            "create-comments",
            "view-comments",
            "edit-comments",
            "delete-comments",
            "create-certificates",
            "view-certificates",
            "edit-certificates",
            "delete-certificates",
            "create-companies",
            "view-companies",
            "edit-companies",
            "delete-companies",
        ];
    }
    public static function adminPermissions()
    {
        return [
            "view-dashboard",
            "create-any-users",
            "view-any-users",
            "edit-any-users",
            "delete-any-users",
            "create-roles",
            "view-roles",
            "edit-roles",
            "delete-roles",
            "view-any-profiles",
            "edit-any-profiles",
            "view-any-posts",
            "edit-any-posts",
            "delete-any-posts",
            "view-any-jobs",
            "edit-any-jobs",
            "delete-any-jobs",
            "view-any-skills",
            "edit-any-skills",
            "delete-any-skills",
            "view-any-users-phones",
            "edit-any-users-phones",
            "delete-any-users-phones",
            "view-any-experiences",
            "edit-any-experiences",
            "delete-any-experiences",
            "view-any-comments",
            "edit-any-comments",
            "delete-any-comments",
            "view-any-certificates",
            "edit-any-certificates",
            "delete-any-certificates",
            "view-any-companies",
            "edit-any-companies",
            "delete-any-companies",
        ];
    }
}
