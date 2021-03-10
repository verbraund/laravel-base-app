<?php

namespace App\Http\Resources\Media\News;

use App\Http\Resources\BaseResource;
use App\Http\Resources\Media\FileResource;
use App\Http\Resources\Media\ImageResource;
use App\Http\Resources\UserResource;

class NewsResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->filtrateFields([
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'text' => $this->text,
            'categories' => new NewsCategoryCollection($this->categories),
            'user' => new UserResource($this->user),
            'image' => new ImageResource($this->image),
            'attachment' => new FileResource($this->attachment),
            'published' => $this->published,
            'published_at' => ($this->published_at),
            'published_to' => ($this->published_to),
            'created_at' => ($this->created_at),
            'updated_at' => ($this->updated_at),
        ]);
    }
}
