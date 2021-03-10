<?php


namespace App\Services\Api\Media;


use App\Contracts\Api\Media\File as FileContract;
use App\Contracts\Api\Media\QueryFilters;
use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use App\Models\Media\File;

class FileService extends MediaService implements FileContract
{


    protected $storage;
    protected $model = File::class;
    protected $disc = 'public';
    protected $path = 'uploads/files';


    public function __construct(Storage $storage, QueryFilters $filters, PaginateService $paginateService)
    {
        parent::__construct($filters, $paginateService);
        $this->storage = $storage;
    }

    public function save(UploadedFile $uploadFile, $name = null)
    {

        $name = is_null($name) ?
            $this->storage->disk($this->disc)->putFile($this->getPathInStore(),$uploadFile) :
            $this->storage->disk($this->disc)->putFileAs($this->getPathInStore(), $uploadFile, $name);


        $model = $this->create([
            'name' => basename($name),
            'origin' => $uploadFile->getClientOriginalName(),
            'type' => $uploadFile->getClientMimeType(),
            'path' => $this->getPathInStore(),
            'size' => $uploadFile->getSize()
        ]);

        $model->user()->associate(auth()->user());
        $model->save();

        return $model;

    }

    public function download($id)
    {
        return $this->storage->disk($this->disc)
            ->download($this->getById($id)->getPathAndName());
    }

    protected function getPathInStore()
    {
        return  $this->path . '/' . date('Y') . '/' . date('m');
    }

}
