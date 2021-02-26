<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,
        SoftDeletes;

    const ADMIN_NAME = 'Admin';
    const SUPER_ADMIN_NAME = 'SuperAdmin';

    protected $fillable = [
        'name',
        'label'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function resource($name)
    {
        return $this->belongsToMany(Permission::class)
            ->wherePivot('resource_id', Resource::findIdByName($name));
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function resources()
    {
        return $this->belongsToMany(Resource::class, 'permission_role');
    }

}
