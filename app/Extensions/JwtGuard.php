<?php


namespace App\Extensions;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;
use App\Contracts\Api\Auth\Token\Refresh;
use App\Contracts\Api\Auth\Token\Access;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\GuardHelpers;
use Illuminate\Support\Str;

class JwtGuard implements Guard
{
    use GuardHelpers;

    private $request;
    protected $accessTokenService;
    protected $refreshTokenService;
    protected $currentRequestType;

    const BASE_TYPE = 'base';
    const LOGIN_TYPE = 'login';

    public function __construct(
        UserProvider $provider, Request $request , Access $accessTokenService, Refresh $refreshTokenService, $type = self::LOGIN_TYPE
    ){
        $this->provider = $provider;
        $this->request = $request;
        $this->user = null;
        $this->accessTokenService = $accessTokenService;
        $this->refreshTokenService = $refreshTokenService;
        $this->currentRequestType = $type;

    }

    public function user()
    {
        if (! is_null($this->user)) {
            return $this->user;
        }


        if($accessToken = $this->getAccessTokenForRequest()){
            if(
                $this->accessTokenService->isValid($accessToken) &&
                $this->accessTokenService->isNotExpired($accessToken) &&
                $this->accessTokenService->isType($accessToken, $this->currentRequestType)
            ){
                if($id = $this->accessTokenService->getSubjectId($accessToken)){

                    $user = $this->provider->retrieveById($id);

                    if(!is_null($user)){
                        $this->setUser($user);
                        return true;
                    }
                }

            }
        }

        if($refreshToken = $this->getRefreshTokenForRequest()){

            if(
                $this->refreshTokenService->isNotExpired($refreshToken) &&
                $this->refreshTokenService->isValid($refreshToken)
            ){
                if($id = $this->refreshTokenService->getSubjectId($refreshToken)){
                    $user = $this->provider->retrieveById($id);
                    if(!is_null($user)){
                        $this->setUser($user);
                        return true;
                    }
                }
            }
        }



    }

    private function getAccessTokenForRequest()
    {
        return $this->request->bearerToken();
    }

    private function getRefreshTokenForRequest()
    {
        return $this->request->cookie($this->refreshTokenService->getTokenName());
    }

    public function validate(array $credentials = [])
    {
        if(isset($credentials['login']) && isset($credentials['password'])){
            $user = $this->provider->retrieveByCredentials($credentials);
            if (!is_null($user) && $this->provider->validateCredentials($user, $credentials)) {
                $this->setUser($user);
                return true;
            }
        }
        return false;
    }

    public static function parseType($name)
    {
        return Str::after($name, '/');
    }

    public function getLoginType()
    {
        return self::LOGIN_TYPE;
    }

    public function getBaseType()
    {
        return self::BASE_TYPE;
    }



}
