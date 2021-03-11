<?php


namespace App\Services\Api\Admin;

use App\Contracts\Api\Admin\Menu as MenuContract;
use App\Contracts\Api\Media\User as UserContract;
use App\Models\Admin\Menu;

class MenuService implements MenuContract
{

    protected $userService;

    public function __construct(UserContract $userService)
    {
        $this->userService = $userService;
    }

    public function getForCurrentUser()
    {
        $user = $this->userService->getCurrentAuthenticated();

        if($user->role->isSuperAdmin()){
            return Menu::with('childes')->main()->get();
        }

        $resources = $user->role->resources->pluck('id')->unique();
        $response = collect();

        $menus = Menu::with(['resource', 'childes' => function($query) use($resources){
            $query->whereResourcesOrNull($resources);
        }])->main()->get();

        foreach ($menus as $k => $menu){
            if(
                $menu->childes->count() > 0 ||
                (
                    !$menu->isDropDown() and
                    (is_null($menu->resource) || ($menu->resource !== null && $resources->contains($menu->resource->id)))
                )
            ){
                $response->push($menu);
            }
        }

       return $response;
    }




}
