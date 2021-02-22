<?php

namespace App\Models\Media\News;

use App\Extensions\Searchable;
use App\Models\User;
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
        'published_at',
        'user_id'
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

    public function categories()
    {
        return $this->belongsToMany(NewsCategory::class, 'news_category', 'news_id', 'category_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
