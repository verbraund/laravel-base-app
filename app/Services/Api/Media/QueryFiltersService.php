<?php


namespace App\Services\Api\Media;


use App\Contracts\Api\Media\QueryFilters;
use Illuminate\Http\Request;

class QueryFiltersService implements QueryFilters
{

    protected $sortService;
    protected $searchService;
    protected $request;

    public function __construct(Request $request, SortService $sortService, SearchService $searchService)
    {
        $this->sortService = $sortService;
        $this->searchService = $searchService;
        $this->request = $request;
    }

    public function apply($query)
    {

        $query = $this->searchService->apply($query, $this->request);
        $query = $this->sortService->apply($query, $this->request);

        return $query;
    }

}
