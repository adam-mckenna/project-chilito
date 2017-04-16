<?php

namespace App\Api\Auth;

use App\Api\Base\BaseController;
use \App\Api\Users\UserTransformer;
use Dingo\Api\Contract\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;

class AuthenticationController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs;

    private $authService;

    public function __construct(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $this->authService->login($request->only('email', 'password'));
        return $this->response->item(auth()->user(), new UserTransformer)
            ->addMeta('token', $this->authService->getAuthToken(auth()->user()));
    }

    public function logout()
    {
        $this->authService->logout();
        return $this->response->noContent();
    }

    public function checkAuth()
    {
        $user = $this->authService->check();
        return $this->response->item($user, new UserTransformer())
            ->addMeta('token', $this->authService->getAuthToken(auth()->user()));
    }
}