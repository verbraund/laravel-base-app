<?php


namespace App\Services\Api\Media;


use App\Contracts\Api\Media\Media;
use App\Contracts\Api\Media\QueryFilters;

class MediaService implements Media
{

    protected $model;
    protected $filters;
    protected $paginator;


    public function __construct(QueryFilters $filters, PaginateService $paginateService)
    {
        $this->filters = $filters;
        $this->paginator = $paginateService;
    }

    public function getAll()
    {
        return $this->paginator->apply(
            $this->filters->apply(
                $this->getModel()->newQuery()
            )
        );
    }

    public function getById($id)
    {
        return $this->getBy('id', $id);
    }

    public function create($data)
    {
        return $this->getModel()
            ->newQuery()
            ->create($data);
    }

    public function update($id, $data)
    {
        $model = $this->getById($id);
        $model->fill($data);
        $model->save();
        return $model;
    }

    public function delete($id)
    {
        $model = $this->getById($id);
        return $model->delete();
    }

    public function getBy($name, $value)
    {
        return $this->getModel()
            ->newQuery()
            ->where($name, $value)
            ->firstOrFail();
    }

    public function getModel()
    {
        return new $this->model;
    }


}
