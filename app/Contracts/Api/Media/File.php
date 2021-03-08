<?php


namespace App\Contracts\Api\Media;


use Illuminate\Http\UploadedFile;

interface File
{

    public function save(UploadedFile $uploadFile, $name = null);

    public function saveMany($files, $names);

}
