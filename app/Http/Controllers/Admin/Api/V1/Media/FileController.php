<?php


namespace App\Http\Controllers\Admin\Api\V1\Media;


use App\Http\Controllers\Controller;
use App\Contracts\Api\Media\File;
use App\Http\Requests\Api\V1\Media\FileRequest;

class FileController extends Controller
{

    private $fileService;

    public function __construct(File $fileService){
        $this->fileService = $fileService;
    }

    public function store(FileRequest $request){
        dd($request->hasFile('data'),$request->file('data'));

        if($request->hasFile('data')){
            $this->fileService->save($request->file('data'));
        }
    }




}
