<?php


namespace App\Services\Api\Media;


use App\Contracts\Api\Media\File;
use Illuminate\Http\UploadedFile;

class FileService implements File
{

    public function save(UploadedFile $file, $name = null)
    {

    }

    public function saveMany($files, $names = [])
    {

    }

    public function generateName()
    {
        return md5(random_bytes(32)) . '_' . md5(time());
    }
}
