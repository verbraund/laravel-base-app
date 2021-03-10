<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\SoftDeletes;

class Menu
{
    use SoftDeletes;

    protected $table = 'admin_menus';

    protected $fillable = [
        'name',
        'urn'
    ];
}
