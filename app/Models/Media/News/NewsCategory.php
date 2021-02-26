<?php

namespace App\Models\Media\News;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'user_id'
    ];

    public function news()
    {
        return $this->belongsToMany(News::class, 'news_category', 'category_id', 'news_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
