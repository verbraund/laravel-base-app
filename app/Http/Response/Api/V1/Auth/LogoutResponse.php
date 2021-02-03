<?php


namespace App\Http\Response\Api\V1\Auth;


class LogoutResponse extends AuthResponse
{

    public function __construct()
    {
        parent::__construct([], 204);
    }
}
