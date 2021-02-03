<?php


namespace App\Models\Auth;


use Illuminate\Database\Eloquent\Model;

class AccessToken extends Model
{

    public $admin_id = null;
    public $token = null;
    public $user_agent = null;
    public $ip_address = null;
    public $expiration_in = null;

}
