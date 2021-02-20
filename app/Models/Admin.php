<?php

namespace App\Models;

use App\Contracts\Api\Auth\TFAUser;
use App\Models\Auth\RefreshToken;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    TFAUser
{
    use HasFactory;

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

    /**
     * @inheritDoc
     */
    public function getAuthIdentifierName()
    {
        return $this->getKeyName();
    }

    /**
     * @inheritDoc
     */
    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    /**
     * @inheritDoc
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getRememberToken()
    {
        // TODO: Implement getRememberToken() method.
    }

    /**
     * @inheritDoc
     */
    public function setRememberToken($value)
    {
        // TODO: Implement setRememberToken() method.
    }

    /**
     * @inheritDoc
     */
    public function getRememberTokenName()
    {
        // TODO: Implement getRememberTokenName() method.
    }

    /**
     * @inheritDoc
     */
    public function can($abilities, $arguments = [])
    {
        // TODO: Implement can() method.
    }

    /**
     * @inheritDoc
     */
    public function getEmailForPasswordReset()
    {
        // TODO: Implement getEmailForPasswordReset() method.
    }

    /**
     * @inheritDoc
     */
    public function sendPasswordResetNotification($token)
    {
        // TODO: Implement sendPasswordResetNotification() method.
    }
}
