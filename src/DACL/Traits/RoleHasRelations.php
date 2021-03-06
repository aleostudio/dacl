<?php
namespace AleoStudio\DACL\Traits;

use AleoStudio\DACL\Models\Permission;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


trait RoleHasRelations
{
    /**
     * Role belongs to many permissions.
     *
     * @return BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(config('dacl.models.permission'))->withTimestamps()->withPivot('granted');
    }


    /**
     * Role belongs to many users.
     *
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(config('auth.model'))->withTimestamps();
    }


    /**
     * Role belongs to parent role.
     *
     * @return BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(config('dacl.models.role'),'parent_id');
    }


    public function ancestors()
    {
        $ancestors = $this->where('id', '=', $this->parent_id)->get();
        while ($ancestors->last() && $ancestors->last()->parent_id !== null)
        {
            $parent = $this->where('id', '=', $ancestors->last()->parent_id)->get();
            $ancestors = $ancestors->merge($parent);
        }
        return $ancestors;
    }


    /**
     * Role has many children roles
     *
     * @return HasMany
     */
    public function children()
    {
        return $this->hasMany(config('dacl.models.role'),'parent_id');
    }

    public function descendants()
    {
        $descendants = $this->where('parent_id', '=', $this->id)->get();

        foreach($descendants as $descendant)
            $descendants = $descendants->merge($descendant->descendants());

        return $descendants;
    }


    /**
     * Attach permission to a role.
     *
     * @param int|Permission $permission
     * @param bool $granted
     * @return bool|int
     */
    public function attachPermission($permission, $granted = true)
    {
        return (!$this->permissions()->get()->contains($permission)) ? $this->permissions()->attach($permission, array('granted' => $granted)) : true;
    }


    /**
     * Detach permission from a role.
     *
     * @param int|Permission $permission
     * @return int
     */
    public function detachPermission($permission)
    {
        return $this->permissions()->detach($permission);
    }


    /**
     * Detach all permissions.
     *
     * @return int
     */
    public function detachAllPermissions()
    {
        return $this->permissions()->detach();
    }
}
