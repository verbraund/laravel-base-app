<?php


namespace App\Http\Requests\Api\V1\Media\News;


use App\Http\Requests\Api\V1\BaseRequest;

class NewsCategoryCreateRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'slug' => 'nullable|string|max:255',
        ];
    }
}
