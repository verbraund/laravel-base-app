<?php


namespace App\Contracts\Api\Media;


interface QueryFilters
{

    public function apply($query, $request);

}
