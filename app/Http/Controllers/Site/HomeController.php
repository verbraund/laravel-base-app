<?php

namespace App\Http\Controllers\Site;

use App\Contracts\Api\Auth\TFA;
use App\Http\Controllers\Controller;
use App\Models\Media\News\News;
use App\Services\Api\Auth\JOSE\JWTParser;
use Illuminate\Http\Request;
use App\Services\Api\Auth\JOSE\JWT;
use App\Services\Api\Auth\JOSE\JWS;
use App\Services\Api\Auth\JWTService;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    public function index(Request $request, JWTService $JWTService, TFA $TFAService)
    {


        Admin::find(1)->can('view',News::class);
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
//        $user = 'admin';
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
