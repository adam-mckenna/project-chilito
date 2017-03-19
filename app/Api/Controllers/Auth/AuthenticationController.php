<?php

namespace App\Api\Controllers\Auth;

use App\Api\Models\User;
use App\Api\Transformers\UserTransformer;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
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

    public function authenticate()
    {
        dd('eyup');
//        $credentials = $request->only('email', 'password');
//
//        try {
//            // attempt to verify the credentials and create a token for the user
//            if (! $token = JWTAuth->attempt($credentials)) {
//                return response()->json(['error' => 'invalid_credentials'], 401);
//            }
//        } catch (JWTException $e) {
//            // something went wrong whilst attempting to encode the token
//            return response()->json(['error' => 'could_not_create_token'], 500);
//        }
//
//        // all good so return the token
//        return response()->json(compact('token'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->where('active', 1)->first();
        if (!$user || !$token = $this->auth->attempt($credentials)) {
            throw new NotFoundHttpException;
        }

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