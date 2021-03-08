<?php


namespace App\Http\Controllers\Admin\Api\V1\Media;

use App\Contracts\Api\Media\Image;
use App\Http\Requests\Api\V1\Media\ImageRequest;
use App\Http\Resources\Media\ImageResource;

class ImageController
{

    private $imageService;

    public function __construct(Image $imageService){
        $this->imageService = $imageService;
    }

    public function store(ImageRequest $request){
        if($request->hasFile('data') && $request->file('data')->isValid()){
            return new ImageResource($this->imageService->save($request->file('data')));
        }
    }

    public function show($id)
    {
        return new ImageResource($this->imageService->getById($id));
    }
}
