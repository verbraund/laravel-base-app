<?php

namespace App\Models\Media\News;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

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
}
