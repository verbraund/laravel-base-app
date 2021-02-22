<?php

namespace App\Services\Api\Auth;

use App\Exceptions\Auth\JOSE\JoseException;
use App\Models\User;
use App\Services\Api\Auth\JOSE\JWT;
use App\Services\Api\Auth\JOSE\JWTParser;
use App\Contracts\Api\Auth\Token\Access;
use Illuminate\Support\Str;

class JWTService implements Access
{


    public function createToken(User $user, $type = '')
    {
        try{

            $jwt = new JWT();
            $jwt->addToPayload([
                'id' => $user->id,
                'ua' => $this->getUserAgent(),
                'ip' => $this->getIp(),
                'tp' => $type
            ]);
            $jwt->setExpirationTime($this->getExpirationTime());

            return $jwt->getToken();

        }catch (JoseException $e){
            return false;
        }
    }

    public function isType($token, $type)
    {
        try{
            $parser = new JWTParser($token);
            $payload = $parser->getDecodedPayload();
            return isset($payload['tp']) && strtolower($payload['tp']) == strtolower($type);
        }catch (JoseException $e){
            return false;
        }
    }

    public function getSubjectId($token)
    {
        try{
            $parser = new JWTParser($token);
            $payload = $parser->getDecodedPayload();
            return isset($payload['id']) ? (int)$payload['id'] : false;
        }catch (JoseException $e){
            return false;
        }
    }

    public function isNotExpired($token)
    {
        try{
            $parser = new JWTParser($token);
            $jwt = new Jwt();
            $jwt->setPayload($parser->getDecodedPayload());
            return $jwt->getExpirationTimeout() > time();
        }catch (JoseException $e){
            return false;
        }
    }

    public function isValid($token)
    {
        try{
            $parser = new JWTParser($token);

            $original = new JWT();
            $original->setHeader($parser->getDecodedHeader());
            $original->setPayload($parser->getDecodedPayload());

            return $original->getSignature() == $parser->getSignature();
        }catch (JoseException $e){
            return false;
        }
    }

    private function getUserAgent()
    {
        return md5(request()->header('user-agent', 'none'));
    }

    private function getIp()
    {
        return md5(request()->getClientIp());
    }

    private function getExpirationTime()
    {
        return config('auth.token_access_expire', 30) * 60;
    }

    public function getTokenName()
    {
        return 'access-token';
    }

}
