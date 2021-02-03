<?php


namespace App\Contracts\Api\Auth\Token;


use App\Models\Admin;

interface Access
{

    public function createToken(Admin $admin, $type = '');

    public function isType($token, $type);

    public function isNotExpired($token);

    public function isValid($token);

    public function getSubjectId($token);

    public function getTokenName();

}
