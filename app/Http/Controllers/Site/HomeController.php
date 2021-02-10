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
use Illuminate\Support\Str;

class HomeController extends Controller
{

    public function index(Request $request, JWTService $JWTService, TFA $TFAService)
    {

        //dd($request->query('test', 1));

        $model = new News();

        $q1 = $model->newQuery();
        $q1->where('id', '>', 1);

        //$q2 = clone $q1;


        dd($q1->count());


        $admin = Admin::find(1);


        dd(Str::slug('Тест бла бла бла навальный!'));
        dd($TFAService->getCode($admin));

        $g = new \Google\Authenticator\GoogleAuthenticator();

        $user = 'admin';
        $salt = sha1(time().$user);
        $secret = $user.$salt;
        $secret = $g->generateSecret();
        $host = 'laravel.base';


        $string = 'otpauth://totp/'.$user.'@'.$host.'?secret='. $secret;

        $qrCode = new \Endroid\QrCode\QrCode($string);

        //header('Content-Type: '.$qrCode->getContentType());
        return response(
            $qrCode->writeString()
        )->header('Content-Type', $qrCode->getContentType());
        //return $qrCode->writeString();

        return '<img src="'.$g->getURL($user, 'example.com', $secret).'" />';

//        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1YSI6IjlhYjI0ZDA5YmE2OGZlNWM4NTRmZTU4ZTEyZWE3ZGQzIiwiZXhwIjoxNjA1NzM3NDc0LCJpYXQiOjE2MDU3MzU2NzR9.nip8PcIdWswVMHtS8k6lUK1wK3BQvzVwV7K1XuajHNw';
//
//        $userToken = new JWTParser($token);
//
//
//        $originalToken = new JWT();
//        $originalToken->setHeader($userToken->getDecodedHeader());
//        $originalToken->setPayload($userToken->getDecodedPayload());
//
//
//
//        dd($userToken->getSignature() == $originalToken->getSignature());
        //$jws = new JWS('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1YSI6IjlhYjI0ZDA5YmE2OGZlNWM4NTRmZTU4ZTEyZWE3ZGQzIiwiZXhwIjoxNjA1NzM2OTgxLCJpYXQiOjE2MDU3MzUxODF9');

//        dd($jwt->getToken());
//        dd($JWTService);
        //dd(base64UrlEncode('{"test":"большая строка тут и сейчас"}'));
        //dd(base64UrlDecode('eyJ0ZXN0Ijoi0LHQvtC70YzRiNCw0Y8g0YHRgtGA0L7QutCwINGC0YPRgiDQuCDRgdC10LnRh9Cw0YEifQ'));
        return view('site.pages.index');
    }

    public function test()
    {
        dd('test');
    }
}
