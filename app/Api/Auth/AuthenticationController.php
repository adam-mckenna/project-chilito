<?php

namespace App\Api\Auth;

use \App\Api\Users\User;
use \App\Api\Users\UserTransformer;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\JWTAuth;

class AuthenticationController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Helpers;

    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    private $auth;

    public function __construct(JWTAuth $auth)
    {
        $this->auth = $auth;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->where('active', 1)->first();
        if (!$user || !$token = $this->auth->attempt($credentials))
            throw new NotFoundHttpException;

        $remember = true;
        event(new Login(auth()->user(), $remember));
        $user = auth()->user();
        return $this->response->item($user, new UserTransformer)->addMeta('token', $token);
    }

    public function logout()
    {
         dd('eyp');
        $this->authService->logout();
        return $this->response->noContent();
    }

    public function checkAuth()
    {
        dd('eyp');
        $user = $this->authService->check();
        return $this->response->item($user, new UserTransformer());
    }
}