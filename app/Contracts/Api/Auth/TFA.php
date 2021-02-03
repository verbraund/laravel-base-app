<?php


namespace App\Contracts\Api\Auth;


interface TFA
{

    public function isValidCode(TFAUser $user, $code);

    public function getCode(TFAUser $user);

    public function isEnabled(TFAUser $user);

}
