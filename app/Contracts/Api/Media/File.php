<?php


namespace App\Contracts\Api\Media;


use Illuminate\Http\UploadedFile;

interface File
{

    public function save(UploadedFile $file, $name);

    public function saveMany($files, $names);

    public function generateName();

}
