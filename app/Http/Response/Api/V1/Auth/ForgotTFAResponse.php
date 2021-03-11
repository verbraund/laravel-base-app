<?php


namespace App\Http\Response\Api\V1\Auth;


class ForgotTFAResponse extends AuthResponse
{

    public function __construct($code = 201)
    {
        parent::__construct([], $code);
    }
}
