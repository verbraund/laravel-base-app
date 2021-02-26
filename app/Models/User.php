<?php

namespace App\Models;

use App\Contracts\Api\Auth\TFAUser;
use App\Models\Auth\RefreshToken;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    TFAUser
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'role_id',
        'login',
        'password',
        'tfa',
        'tfa_code',
    ];

    protected $hidden = [
        'password',
        'tfa_code'
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function refreshTokens()
    {
        return $this->hasMany(RefreshToken::class);
    }

    public function isTfaEnabled()
    {
        return (bool)$this->tfa;
    }

    public function getTfaCode()
    {
        return $this->tfa_code;
    }

    public function setTfaCode($tfa)
    {
        $this->tfa_code = $tfa;
    }

    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken(){}

    public function setRememberToken($value){}

    public function getRememberTokenName(){}

    public function can($abilities, $arguments = []){}

    public function getEmailForPasswordReset(){}

    public function sendPasswordResetNotification($token){}
}
