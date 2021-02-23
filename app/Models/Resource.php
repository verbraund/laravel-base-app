<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'label'
    ];

    public function scopeName($query, $name)
    {
        return $query->where('name', $name);
    }

    public static function findIdByName($name)
    {
        return (int)self::name($name)->value('id');
    }

}
