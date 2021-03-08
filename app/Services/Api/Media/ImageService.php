<?php


namespace App\Services\Api\Media;

use App\Contracts\Api\Media\Image as ImageContract;
use App\Models\Media\Image;

class ImageService extends FileService implements ImageContract
{

    protected $model = Image::class;
    protected $path = 'uploads/images';



}
