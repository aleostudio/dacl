<?php
namespace AleoStudio\DACL\Contracts;

use AleoStudio\DACL\Models\Role;
use AleoStudio\DACL\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


interface HasRoleAndPermission
{
    /**
     * User belongs to many roles.
     *
     * @return BelongsToMany
     */
    public function roles();


    /**
     * Get all roles as collection.
     *
     * @return Collection
     */
    public function getRoles();


    /**
     * Check if the user has a role or roles.
     *
     * @param int|string|array $role
     * @param bool $all
     * @return bool
     */
    public function roleIs($role, $all = false);


    /**
     * Attach role to a user.
     *
     * @param int|Role $role
     * @param bool $granted
     * @return bool|null
     */
    public function attachRole($role, $granted = TRUE);


    /**
     * Detach role from a user.
     *
     * @param int|Role $role
     * @return int
     */
    public function detachRole($role);


    /**
     * Detach all roles from a user.
     *
     * @return int
     */
    public function detachAllRoles();


    /**
     * Get all permissions from roles.
     *
     * @return Collection
     */
    public function rolePermissions();


    /**
     * User belongs to many permissions.
     *
     * @return BelongsToMany
     */
    public function userPermissions();


    /**
     * Get all permissions as collection.
     *
     * @return Collection
     */
    public function getPermissions();


    /**
     * Check if the user has a permission or permissions.
     *
     * @param int|string|array $permission
     * @param bool $all
     * @return bool
     */
    public function may($permission, $all = false);


    /**
     * Check if the user is allowed to manipulate with entity.
     *
     * @param string $providedPermission
     * @param Model $entity
     * @param bool $owner
     * @param string $ownerColumn
     * @return bool
     */
    public function allowed($providedPermission, Model $entity, $owner = true, $ownerColumn = 'user_id');


    /**
     * Attach permission to a user.
     *
     * @param int|Permission $permission
     * @param bool $granted
     * @return bool|null
     */
    public function attachPermission($permission, $granted = TRUE);


    /**
     * Detach permission from a user.
     *
     * @param int|Permission $permission
     * @return int
     */
    public function detachPermission($permission);


    /**
     * Detach all permissions from a user.
     *
     * @return int
     */
    public function detachAllPermissions();
}
