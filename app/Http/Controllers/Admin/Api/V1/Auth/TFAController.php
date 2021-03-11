<?php


namespace App\Http\Controllers\Admin\Api\V1\Auth;


use App\Contracts\Api\Auth\TFA;
use App\Contracts\Api\Auth\Token\Access;
use App\Contracts\Api\Auth\Token\Refresh;
use App\Events\ForgotTFACode;
use App\Http\Requests\Api\V1\Auth\LoginTfaRequest;
use App\Http\Response\Api\V1\Auth\ForgotTFAResponse;

class TFAController extends LoginController
{


    public function check(LoginTfaRequest $request)
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


    public function forgot()
    {

        ForgotTFACode::dispatch($this->getCurrentUser());
        new ForgotTFAResponse();

    }
}
