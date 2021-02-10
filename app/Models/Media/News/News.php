<?php

namespace App\Models\Media\News;

use App\Extensions\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory,
        Searchable;


    protected $fillable = [
        'title',
        'slug',
        'description',
        'text',
        'published_at'
    ];

    public $sortable = [
        'id','title'
    ];

    protected $searchable = [
        'title',
        'slug',
        'description',
        'text',
    ];
}
