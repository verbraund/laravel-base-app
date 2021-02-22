<?php


namespace App\Contracts\Api\Auth\Token;


use App\Models\User;

interface Access
{

    public function createToken(User $user, $type = '');

    public function isType($token, $type);

    public function isNotExpired($token);

    public function isValid($token);

    public function getSubjectId($token);

    public function getTokenName();

}
