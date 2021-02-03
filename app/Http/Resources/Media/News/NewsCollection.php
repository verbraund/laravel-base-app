<?php

namespace App\Http\Resources\Media\News;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function ($news) {
            return (new NewsResource($news))->except(['description','text']);
        });
        return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'test' => [
                'self' => 'link-value',
            ],
        ];
    }

}
