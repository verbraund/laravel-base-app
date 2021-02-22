<?php


namespace App\Services\Api\Auth;

use App\Contracts\Api\Auth\Token\Refresh;
use App\Models\User;
use App\Models\Auth\RefreshToken;
use Illuminate\Contracts\Hashing\Hasher;
use Carbon\Carbon;


class SimpleToken implements Refresh
{

    private $model;
    private $hashManager;


    public function __construct(RefreshToken $model, Hasher $hashManager)
    {
        $this->model = $model;
        $this->hashManager = $hashManager;
    }

    public function createToken(User $user)
    {
        $token = $this->generateHash();
        $this->model->create([
            'user_id' => $user->id,
            'token' => $token,
            'user_agent' => $this->getUserAgent(),
            'ip_address' => $this->getIpAddress(),
            'expiration_in' => Carbon::now()->addMinutes($this->getExpirationTime()),
        ]);
        return $token;
    }

    public function regenerateToken(User $user)
    {
        $this->model->where('user_id', $user->id)->delete();
        return $this->createToken($user);
    }

    public function removeTokens(User $user)
    {
        $this->model->where('user_id', $user->id)->delete();
    }

    public function isNotExpired($token)
    {
        return $this->model->token($token)
            ->where('expiration_in', '>', Carbon::now())
            ->exists();
    }

    public function isValid($token)
    {
        $token = $this->model->token($token)->first();
        if($token){
            if(
                $token->user_agent == $this->getUserAgent() &&
                $token->ip_address == $this->getIpAddress()
            ){
                return true;
            }
        }
        return false;
    }

    public function getSubjectId($token)
    {
        $token = $this->model->token($token)->first();
        if($token){
            return (int)$token->user_id;
        }
        return false;
    }

    private function generateHash()
    {
        return $this->hashManager->make(time() . rand());
    }

    private function getIpAddress()
    {
        return request()->getClientIp();
    }

    private function getUserAgent()
    {
        return request()->header('user-agent', 'none');
    }

    public function getExpirationTime()
    {
        return config('auth.token_refresh_expire', 240);
    }

    public function getTokenName()
    {
        return 'refresh-token';
    }

}
