<?php

namespace App\Http\Controllers\Admin\Api\V1\Auth;

use App\Contracts\Api\Auth\TFA;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\LoginTfaRequest;
use App\Http\Response\Api\V1\Auth\LoginResponse;
use App\Http\Response\Api\V1\Auth\LogoutResponse;
use App\Http\Response\Api\V1\Auth\RefreshResponse;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Contracts\Api\Auth\Token\Access;
use App\Contracts\Api\Auth\Token\Refresh;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    private $refreshTokenService;
    private $accessTokenService;
    private $TFAService;

    public $maxAttempts = 6;
    public $decayMinutes = 10;

    public function __construct(
        Refresh $refreshTokenService, Access $accessTokenService, TFA $TFAService
    ){
        $this->refreshTokenService = $refreshTokenService;
        $this->accessTokenService = $accessTokenService;
        $this->TFAService = $TFAService;
    }

    public function login(LoginRequest $request)
    {

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->sendLockoutResponse($request);
        }

        if ($this->guard()->validate($this->credentials($request))) {
            $this->clearLoginAttempts($request);

            if($this->TFAService->isEnabled($this->getCurrentUser())){

                return $this->sendTfaResponse();
            }

            return $this->sendSuccessResponse();

        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function refresh()
    {
        return $this->sendSuccessResponse();
    }

    protected function sendTfaResponse()
    {
        $code = null;

        if($this->TFAService->isFirstLogin($this->getCurrentUser())){
            $this->TFAService->setSecretCode($this->getCurrentUser());
            $code = $this->TFAService->getSecretQrCode($this->getCurrentUser());
        }

        return (new LoginResponse(true, $code))
            ->withAccessToken(
                $this->accessTokenService->getTokenName(),
                $this->accessTokenService->createToken(
                    $this->getCurrentUser(),
                    $this->guard()->getLoginType()
                )
            );
    }

    protected function sendSuccessResponse()
    {
        return (new RefreshResponse())
            ->withAccessToken(
                $this->accessTokenService->getTokenName(),
                $this->accessTokenService->createToken(
                    $this->getCurrentUser(),
                    $this->guard()->getBaseType()
                )
            )->withRefreshToken(
                $this->refreshTokenService->getTokenName(),
                $this->refreshTokenService->regenerateToken(
                    $this->getCurrentUser()
                ),
                $this->refreshTokenService->getExpirationTime()
            );
    }

    public function twoFactorAuth(LoginTfaRequest $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->sendLockoutResponse($request);
        }

        if($this->TFAService->isValidCode($this->getCurrentUser(), $request->code)){
            $this->clearLoginAttempts($request);
            return $this->sendSuccessResponse();
        }

        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function logout()
    {
        $admin = $this->getCurrentUser();
        $this->refreshTokenService->removeTokens($admin);

        return new LogoutResponse;
    }

    protected function getCurrentUser(){
        return $this->guard()->user();
    }

    public function username()
    {
        return 'login';
    }

    protected function throttleKey(Request $request)
    {
        return Str::lower(
            ($request instanceof LoginTfaRequest) ?
                $this->getCurrentUser()->login :
                $request->input($this->username())
            ).'|'.$request->ip();
    }


}
