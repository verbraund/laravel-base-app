<?php


namespace App\Http\Controllers\Admin\Api\V1\Media;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Media\News\NewsCreateRequest;
use App\Http\Requests\Api\V1\Media\News\NewsUpdateRequest;
use App\Http\Resources\Media\News\NewsCollection;
use App\Http\Resources\Media\News\NewsResource;
use App\Contracts\Api\Media\News as NewsService;

class NewsController extends Controller
{

    protected $newsService;

    public function __construct(NewsService $newsService)
    {

        $this->newsService = $newsService;
        $this->authorizeResource(get_class($this->newsService->getModel()));

    }

    public function index()
    {
        return new NewsCollection($this->newsService->getAll());
    }

    public function store(NewsCreateRequest $request)
    {
        return new NewsResource($this->newsService->create($request->all()));
    }

    public function edit($id)
    {
        return new NewsResource($this->newsService->getById($id));
    }

    public function update(NewsUpdateRequest $request, $id)
    {
        return new NewsResource($this->newsService->update($id, $request->all()));
    }

    public function destroy($id)
    {
        $this->newsService->delete($id);
    }


}
