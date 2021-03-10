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

    public function create($data)
    {
        $news = parent::create($data);
        $news->user()->associate(auth()->user());
        $news->categories()->sync($data['categories']);
        $news->save();
        return $news;
    }

    public function update($id, $data)
    {
        $news = parent::update($id, $data);
        $news->user()->associate(auth()->user());
        $news->image()->associate($data['image']);
        $news->attachment()->associate($data['attachment']);
        $news->categories()->sync($data['categories']);
        $news->save();
        return $news;
    }
}
