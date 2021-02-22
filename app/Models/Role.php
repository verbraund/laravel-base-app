<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
        //->wherePivot('resource_id', $resource->id);
    }

    public function resources()
    {
        return $this->belongsToMany(Resource::class, 'permission_role');
            //->wherePivot('resource_id', $resource->id);
    }

    public function scopeGetPermissions($query, $name)
    {
        return $this->permissions()->wherePivot('resource_id',1);
    }

    public function hasPermissionForResource($permission,$resource)
    {

        return $this->belongsToMany(Resource::class, 'permission_role')
            ->wherePivot('resource_id', $resource)
            ->wherePivot('permission_id', $permission);
    }

//    public function hasPermissionForResource($permission,$resource)
//    {
//
//        return $this->belongsToMany(Resource::class)
//            ->wherePivot('resource_id', $resource)
//            ->wherePivot('permission_id', $permission);
//    }

}
