<?php

namespace Tests\Unit;

use App\Api\Auth\AuthenticationService;
use App\Api\Users\User;
use Faker\Factory as Faker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    private $faker;

    private $user;

    private $authService;

    public function setUp()
    {
        $this->faker = Faker::create();
        $this->user = new User([
            'id' => 1,
            'email' => $this->faker->email,
            'password' => 'password',
        ]);
        $this->authService = new AuthenticationService();
    }

    /**
     * Test that the User can login
     *
     * @return void
     */
    public function testUserCanLogin()
    {
        $this->authService->login([
            "email" => $this->user->email,
            "password" => $this->user->password
        ]);
//        $this->assertTrue(JWTAuth::setToken($authService->getToken())->authenticate()->exists());
//        $this->assertEquals($userService->getUser()->id, JWTAuth::user()->id);
    }
}
