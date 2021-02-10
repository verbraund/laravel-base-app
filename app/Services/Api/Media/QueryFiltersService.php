<?php


namespace App\Services\Api\Media;


use App\Contracts\Api\Media\QueryFilters;

class QueryFiltersService implements QueryFilters
{

    protected $sortService;
    protected $searchService;

    public function __construct(SortService $sortService, SearchService $searchService)
    {
        $this->sortService = $sortService;
        $this->searchService = $searchService;
    }

    public function apply($query, $request)
    {

        $query = $this->searchService->apply($query, $request);
        $query = $this->sortService->apply($query, $request);

        return $query;
    }

}
