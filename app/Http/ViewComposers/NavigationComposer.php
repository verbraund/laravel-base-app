<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class NavigationComposer
{
    public function compose(View $view){
        $view->with('menu', [
            (object)['url' => '/' , 'name' => 'Главная'],
            (object)['url' => '/books' , 'name' => 'Книги']
        ]);
    }
}
