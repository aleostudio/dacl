<?php
namespace AleoStudio\DACL\Models;

use Illuminate\Database\Eloquent\Model;
use AleoStudio\DACL\Traits\RoleHasRelations;
use AleoStudio\DACL\Contracts\RoleHasRelations as RoleHasRelationsContract;


class Role extends Model implements RoleHasRelationsContract
{
    use RoleHasRelations;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'parent_id'];


    /**
     * Create a new model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if ($connection = config('dacl.connection')) {
            $this->connection = $connection;
        }
    }
}
