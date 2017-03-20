<?php

namespace App\Api\Users;

use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, Helpers;

    private $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->only('name', 'email', 'password', 'active');
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepo->create($request->json('id'), $data);
        return $this->response->item($user, new UserTransformer);
    }
}