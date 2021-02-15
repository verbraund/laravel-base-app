<?php


namespace App\Http\Resources\Media\News;


use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsCategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function ($newsCategory) {
            return new NewsCategoryResource($newsCategory);
        });
        return parent::toArray($request);
    }
}
