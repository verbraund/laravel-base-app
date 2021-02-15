<?php


namespace App\Http\Resources\Media\News;


use App\Http\Resources\BaseResource;

class NewsCategoryResource extends BaseResource
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
            'created_at' => date_custom_format($this->created_at),
            'updated_at' => date_custom_format($this->updated_at),
        ]);
    }
}
