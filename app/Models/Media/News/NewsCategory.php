<?php

namespace App\Models\Media\News;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use HasFactory;

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
        return $this->belongsTo(Admin::class, 'id', 'user_id');
    }
}
