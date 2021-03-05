<?php


namespace App\Http\Requests\Api\V1\Media;


use App\Http\Requests\Api\V1\BaseRequest;

class FileRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'data' => 'required|file',
        ];
    }

}
