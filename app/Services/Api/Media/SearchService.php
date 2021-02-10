<?php


namespace App\Services\Api\Media;


use Illuminate\Support\Str;

class SearchService
{

    const QUERY_PARAM_NAME = 'search';
    const SCOPE_NAME = 'search';
    const MIN_SEARCH_LENGTH = 3;

    public function apply($query, $request)
    {

        if(
            $query->hasNamedScope(self::SCOPE_NAME) &&
            $request->has(self::QUERY_PARAM_NAME)
        ){
            $searchString = Str::of($request->query(self::QUERY_PARAM_NAME));
            if($searchString->trim()->isNotEmpty() && $searchString->length() >= self::MIN_SEARCH_LENGTH){
                $query->{self::SCOPE_NAME}($searchString->trim());
            }
        }

        return $query;
    }

}
