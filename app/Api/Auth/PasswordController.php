<?php

namespace App\Api\Auth;


use App\Api\Base\BaseController;
use Dingo\Api\Contract\Http\Request as DingoRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function getResetValidationRules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'confirmed',
                'min:8',
            ]
        ];
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|email']);

        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->getSendResetLinkEmailSuccessResponse($response)
            : $this->getSendResetLinkEmailFailureResponse($response);
    }

    public function getSendResetLinkEmailSuccessResponse($response)
    {
        return $this->response->noContent();
    }

    public function getSendResetLinkEmailFailureResponse($response)
    {
        $this->response->errorBadRequest($response);
    }

    protected function getResetSuccessResponse($response)
    {
        return $this->response->noContent();
    }

    protected function getResetFailureResponse(DingoRequest $request, $response)
    {
        $this->response->errorBadRequest($response);
    }
}