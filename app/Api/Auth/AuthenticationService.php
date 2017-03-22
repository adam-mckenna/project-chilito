<?php

namespace App\Api\Auth;


use App\Api\Users\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Events\Login;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticationService
{
    private $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    public function login($credentials)
    {
        $this->user = $this->getUserByEmail($credentials['email']);
        if (!$this->user || !JWTAuth::attempt($credentials))
            throw new AuthenticationException();

        event(new Login(auth()->user(), true));
    }

    public function logout()
    {
    }

    public function check()
    {
    }

    private function getUserByEmail($email)
    {
        return User::where('email', $email)->where('active', 1)->first();
    }

    public function getAuthToken($user)
    {
        return JWTAuth::fromUser($user);
    }
}