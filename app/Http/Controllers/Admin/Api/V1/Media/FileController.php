<?php


namespace App\Http\Controllers\Admin\Api\V1\Media;


use App\Http\Controllers\Controller;
use App\Contracts\Api\Media\File;
use App\Http\Requests\Api\V1\Media\FileRequest;
use App\Http\Resources\Media\FileResource;


class FileController extends Controller
{

    private $fileService;

    public function __construct(File $fileService){
        $this->fileService = $fileService;
    }

    public function store(FileRequest $request){
        if($request->hasFile('data') && $request->file('data')->isValid()){
            return new FileResource($this->fileService->save($request->file('data')));
        }
    }

    public function show($id)
    {
        return new FileResource($this->fileService->getById($id));
    }




}
