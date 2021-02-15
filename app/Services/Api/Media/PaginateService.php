<?php


namespace App\Services\Api\Media;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class PaginateService
{

    const DEFAULT_PER_PAGE = 10;
    const DEFAULT_CURRENT_PAGE = 1;

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($query)
    {

        $currentPage = $this->checkCurrentPage((int)$this->request->query('page'));
        $limit = $this->checkCurrentLimit((int)$this->request->query('limit'));

        $queryCount = clone $query;

        $items = $query->skip(
            ($limit * $currentPage) - $limit
        )->take(self::DEFAULT_PER_PAGE)->get();

        $count = $queryCount->count();

        $paginator =  new Paginator($items,$count,$limit,$currentPage);
        $paginator->withPath($this->request->url());
        $paginator->appends($this->request->query());

        return $paginator;
    }

    public function paginate($query, $perPage = self::DEFAULT_PER_PAGE)
    {
        return $query->paginate($perPage);
    }

    protected function checkCurrentPage($page)
    {
        return ($page <= 0) ? self::DEFAULT_CURRENT_PAGE : $page;
    }

    protected function checkCurrentLimit($limit)
    {
        return $limit <= 0 ? self::DEFAULT_PER_PAGE : $limit;
    }

}
