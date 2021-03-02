<?php

namespace App\Models\Media\News;

use App\Extensions\Searchable;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory,
        Searchable,
        SoftDeletes;


    protected $fillable = [
        'title',
        'slug',
        'description',
        'text',
        'published',
        'published_at',
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
        return $this->belongsToMany(NewsCategory::class, 'news_category', 'news_id', 'category_id')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
