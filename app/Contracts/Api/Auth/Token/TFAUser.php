<?php


namespace App\Contracts\Api\Auth;


interface TFAUser
{

    public function isTfaEnabled();

    public function getTfaCode();

}
