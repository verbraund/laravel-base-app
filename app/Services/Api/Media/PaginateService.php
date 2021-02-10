<?php


namespace App\Services\Api\Media;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class PaginateService
{

    const DEFAULT_PER_PAGE = 10;
    const DEFAULT_CURRENT_PAGE = 1;

    public function apply($query, $request)
    {

        $currentPage = $this->checkCurrentPage((int)$request->query('page'));
        $limit = $this->checkCurrentLimit((int)$request->query('limit'));

        $queryCount = clone $query;

        $items = $query->skip(
            ($limit * $currentPage) - $limit
        )->take(self::DEFAULT_PER_PAGE)->get();

        $count = $queryCount->count();

        $paginator =  new Paginator($items,$count,$limit,$currentPage);
        $paginator->withPath($request->url());
        $paginator->appends($request->query());

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
