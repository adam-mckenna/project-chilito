<?php

namespace App\Api\Users;

use App\Api\Users\Requests\CreateUserRequest;
use App\Api\Users\Requests\DeleteUserRequest;
use App\Api\Users\Requests\RegisterUserRequest;
use App\Api\Users\Requests\UpdateUserRequest;
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
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        // TODO: put ID generation on API, not front end
        $user = $this->userRepo->create($request->json('id'), $data);
        return $this->response->item($user, new UserTransformer);
    }

    public function register(RegisterUserRequest $request)
    {
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepo->create($request->json('id'), $data);
        return $this->response->item($user, new UserTransformer);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->all();
        if ($request->only('password')['password'])
            $data['password'] = Hash::make($data['password']);

        $user = $this->userRepo->update($id, $data);
        return $this->response->item($user, new UserTransformer);
    }

    public function destroy(DeleteUserRequest $request, $id)
    {
        $this->userRepo->delete($id);
        return $this->response->noContent();
    }
}