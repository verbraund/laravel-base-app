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

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function getAll($request)
    {
        return $this->paginator->apply(
            $this->filters->apply(
                $this->getModel()->newQuery(), $request
            ), $request
        );

//        return $this->paginator->paginate(
//            $this->filters->apply(
//                $this->getModel()->newQuery(), $request
//            )
//        );
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function edit()
    {
        // TODO: Implement edit() method.
    }

    public function getBy($name, $value)
    {
        return $this->getModel()->where($name, $value)->firstOrFail();
    }

    protected function getModel()
    {
        return new $this->model;
    }


}
