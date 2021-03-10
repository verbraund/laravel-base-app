<?php


namespace App\Http\Controllers\Admin\Api\V1;


use App\Http\Controllers\Controller;
use App\Contracts\Api\Admin\Menu as MenuService;
use App\Http\Resources\Admin\MenuCollection;

class AdminMenuController extends Controller
{

    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        return new MenuCollection($this->menuService->getForCurrentUser());
    }

}
