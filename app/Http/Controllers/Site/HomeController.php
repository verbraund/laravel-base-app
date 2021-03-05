<?php

namespace App\Http\Controllers\Site;

use App\Contracts\Api\Auth\TFA;
use App\Http\Controllers\Controller;
use App\Models\Media\News\News;
use App\Models\Media\News\NewsCategory;
use App\Services\Api\Auth\JOSE\JWTParser;
use Illuminate\Http\Request;
use App\Services\Api\Auth\JOSE\JWT;
use App\Services\Api\Auth\JOSE\JWS;
use App\Services\Api\Auth\JWTService;
use App\Models\User;
use App\Models\Resource;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    public function index(Request $request, JWTService $JWTService, TFA $TFAService)
    {

        //dd(News::find(173)->user);


        

        $user = User::find(1);

        $categoryOne = NewsCategory::find(1);
        $categoryTwo = NewsCategory::find(2);

        $data = [
            'description' => "123asdasd",
            'slug' => "asdasd",
            'text' => "asdasdas",
            'title' => "asdasd",
            'categories' => "[1,2]",
        ];

        $model = new News;

        $news = $model->newQuery()->create($data);
        $news->user()->associate($user);
        //$news->categories()->attach([150,151]);
        $news->save();

       dd($news);

        //$model->user()->associate($user);
        //$model->save();

//        $model = new News;
//
//        $model->fill($data);
//
//        $model->user()->associate($user);
//        $model->save();

        //dd($model);




//        dd($user->role->name);
//        dd($user->role->resource($resource)->hasPermission($method));


        //dd($user->role->permission($method)->wherePivot('resource_id',1)->get());
        //dd($user->role->permissions()->test()->get());
        //dd($user->role->permissions()->wherePivot('resource_id',1)->where('name',$method)->exists());
        //dd($user->role->resources()->name('App\Models\Media\News\News')->get());


        //dd($user->role->hasPermissionForResource(1,1)->get());
        //User::find(1)->can('view',News::find(1));
        //auth()->user()->can('view',News::find(1));

        dd(News::find(1));

//        $news = new News();
//
//        $data = [
//            'title' => 'Test 5',
//            'slug' => 'test-5',
//            'description' => '1',
//            'text' => '44444',
//        ];
//
//        $n = $news->newQuery()->where('id', 225)->first();
//        $n->fill($data);
//        $result = $n->save();
//        dd($result);
//
//        $g = new \Google\Authenticator\GoogleAuthenticator();
//
//        $user = 'test';
//        $salt = sha1(time().$user);
//        $secret = $user.$salt;
//        $secret = $g->generateSecret();
//        $host = 'laravel.base';
//
//
//        $string = 'otpauth://totp/'.$user.'@'.$host.'?secret='. $secret;
//
//        $qrCode = new \Endroid\QrCode\QrCode($string);
//
//        //header('Content-Type: '.$qrCode->getContentType());
//        return response(
//            $qrCode->writeString()
//        )->header('Content-Type', $qrCode->getContentType());
//        //return $qrCode->writeString();
//
//        return '<img src="'.$g->getURL($user, 'example.com', $secret).'" />';
        return view('site.pages.index');
    }

}
