<?php


namespace App\Services\Api\Auth;


use App\Contracts\Api\Auth\TFA;
use App\Contracts\Api\Auth\TFAUser;
use \Google\Authenticator\GoogleAuthenticator;
use \Endroid\QrCode\QrCode;

class GoogleAuthQrCode implements TFA
{

    private $qrManager = null;
    private $googleAuth = null;

    public function __construct(GoogleAuthenticator $ga, QrCode $qr)
    {
        $this->googleAuth = $ga;
        $this->qrManager = $qr;

    }

    public function isEnabled(TFAUser $user)
    {
        return $user->isTfaEnabled();
    }

    public function isFirstLogin(TFAUser $user)
    {
        return is_null($user->getTfaCode());
    }

    public function isValidCode(TFAUser $user, $code)
    {
        return $this->googleAuth->checkCode(
            $user->getTfaCode(),
            $code,
            1
        );
    }

    public function getCode(TFAUser $user)
    {
        if($user && $this->isEnabled($user)){
            if($secret = $user->getTfaCode()){
                return $this->googleAuth->getCode($secret);
            }
        }
        return null;
    }

    public function setSecretCode(TFAUser $user)
    {
        $user->setTfaCode($this->googleAuth->generateSecret());
        $user->save();
    }

    public function getSecretQrCode(TFAUser $user)
    {
        if($user && $this->isEnabled($user)){
            if($secret = $user->getTfaCode()){
                $this->qrManager->setText(
                    'otpauth://totp/'.$user->login.'@'.request()->getHost().'?secret='. $secret
                );
                return $this->qrManager->writeDataUri();
            }
        }
        return null;
    }

    public function getTfaName()
    {
        return 'Google Authenticator';
    }

}
