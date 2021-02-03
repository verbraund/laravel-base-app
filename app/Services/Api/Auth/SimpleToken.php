<?php


namespace App\Services\Api\Auth;

use App\Contracts\Api\Auth\Token\Refresh;
use App\Models\Admin;
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

    public function createToken(Admin $admin)
    {
        $token = $this->generateHash();
        $this->model->create([
            'admin_id' => $admin->id,
            'token' => $token,
            'user_agent' => $this->getUserAgent(),
            'ip_address' => $this->getIpAddress(),
            'expiration_in' => Carbon::now()->addMinutes($this->getExpirationTime()),
        ]);
        return $token;
    }

    public function regenerateToken(Admin $admin)
    {
        $this->model->where('admin_id', $admin->id)->delete();
        return $this->createToken($admin);
    }

    public function removeTokens(Admin $admin)
    {
        $this->model->where('admin_id', $admin->id)->delete();
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
            return (int)$token->admin_id;
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
