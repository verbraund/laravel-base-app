<?php


namespace App\Services\Api\Media;


use App\Contracts\Api\Media\QueryFilters;

class QueryFiltersService implements QueryFilters
{

    protected $sortService;

    public function __construct(SortService $sortService)
    {
        $this->sortService = $sortService;
    }

    public function apply($query, $request)
    {

        $query = $this->sortService->apply($query, $request);

        return $query;
    }

}
