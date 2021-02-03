<?php


namespace App\Http\Response\Api\V1\Auth;



class LoginResponse extends AuthResponse
{

    public function __construct($tfa = false, $tfaCode = null)
    {
        parent::__construct([
            'tfa' => $tfa,
            'tfa_code' => $tfaCode
        ], 200);
    }
}

