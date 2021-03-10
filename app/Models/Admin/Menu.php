<?php


namespace App\Models\Admin;


use App\Models\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $table = 'admin_menus';

    protected $fillable = [
        'parent_id',
        'name',
        'urn'
    ];

    public function scopeParents($query)
    {
        return $query->WhereNull('parent_id');
    }

    public function scopeWhereResources($query, $resources = [])
    {
        return $query->WhereIn('resource_id', $resources);
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    public function childes()
    {
        return $this->hasMany(Menu::class, 'parent_id','id' );
    }

    public function isDropDown()
    {
        return !(bool)$this->urn;
    }


}
