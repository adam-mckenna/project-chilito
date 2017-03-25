<?php

namespace App\Api\Auth;

use \App\Api\Users\UserTransformer;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

class AuthenticationController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Helpers;

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