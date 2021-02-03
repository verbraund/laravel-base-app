<?php


namespace App\Services\Api\Media;


use App\Models\Media\News\News as NewsModel;
use App\Contracts\Api\Media\News as NewsContract;

class NewsService extends MediaService implements NewsContract
{

    protected $model = NewsModel::class;

    public function getBySlug($slug)
    {
        return $this->getBy('slug', $slug);
    }
}
