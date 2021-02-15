<?php


namespace App\Http\Controllers\Admin\Api\V1\Media;


use App\Http\Controllers\Controller;
use App\Contracts\Api\Media\NewsCategory as NewsCategoryService;
use App\Http\Requests\Api\V1\Media\News\NewsCategoryCreateRequest;
use App\Http\Requests\Api\V1\Media\News\NewsCategoryUpdateRequest;
use App\Http\Resources\Media\News\NewsCategoryCollection;
use App\Http\Resources\Media\News\NewsCategoryResource;

class NewsCategoryController extends Controller
{

    protected $newsCategoryService;

    public function __construct(NewsCategoryService $newsCategoryService)
    {
        $this->newsCategoryService = $newsCategoryService;
    }

    public function index()
    {
        return new NewsCategoryCollection($this->newsCategoryService->getAll());
    }

    public function edit($id)
    {
        return new NewsCategoryResource($this->newsCategoryService->getById($id));
    }

    public function update(NewsCategoryUpdateRequest $request, $id)
    {
        return new NewsCategoryResource($this->newsCategoryService->update($id, $request->all()));
    }

    public function store(NewsCategoryCreateRequest $request)
    {
        return new NewsCategoryResource($this->newsCategoryService->create($request->all()));
    }

    public function destroy($id)
    {
        $this->newsCategoryService->delete($id);
    }

}
