<?php


namespace App\Http\Controllers\Admin\Api\V1\Media;


use App\Http\Controllers\Controller;
use App\Http\Resources\Media\News\NewsCollection;
use App\Http\Resources\Media\News\NewsResource;
use Illuminate\Http\Request;
use App\Contracts\Api\Media\News as NewsService;

class NewsController extends Controller
{

    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(Request $request)
    {
        return new NewsCollection($this->newsService->getAll($request));
    }

    public function show($slug)
    {
        return new NewsResource($this->newsService->getBySlug($slug));
    }

}
