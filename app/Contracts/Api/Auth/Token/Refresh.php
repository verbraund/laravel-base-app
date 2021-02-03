<?php


namespace App\Contracts\Api\Auth\Token;

use App\Models\Admin;

interface Refresh
{

    public function createToken(Admin $admin);

    public function regenerateToken(Admin $admin);

    public function isNotExpired($token);

    public function isValid($token);

    public function removeTokens(Admin $admin);

    public function getSubjectId($token);

    public function getTokenName();

    public function getExpirationTime();

}
