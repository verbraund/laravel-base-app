<?php


namespace App\Contracts\Api\Auth\Token;

use App\Models\User;

interface Refresh
{

    public function createToken(User $user);

    public function regenerateToken(User $user);

    public function isNotExpired($token);

    public function isValid($token);

    public function removeTokens(User $user);

    public function getSubjectId($token);

    public function getTokenName();

    public function getExpirationTime();

}
