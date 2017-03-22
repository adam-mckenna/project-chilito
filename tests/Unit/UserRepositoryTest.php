<?php

namespace Tests\Unit;

use App\Api\Auth\AuthenticationService;
use App\Api\Users\User;
use App\Api\Users\UserRepository;
use Faker\Factory as Faker;
use Illuminate\Database\QueryException;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    private $faker;
    private $userRepo;

    public function setUp()
    {
        parent::setUp();
        $this->faker = Faker::create();
        $this->userRepo = new UserRepository();
    }

    /**
     * Test that a user can be created
     *
     * @return void
     */
    public function testUserCanBeCreatedFromValidDetails()
    {
        $id = count(User::all()) + 2;
        $user = $this->userRepo->create($id, [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'password' => 'password',
            'active' => 1
        ]);
        $this->assertInstanceOf(User::class, $user);
    }

    /**
     * Test that a user with invalid credentials be created
     *
     * @return void
     */
    public function testUserCannotBeCreatedWithInvalidCredentials()
    {

        $this->expectException(QueryException::class);
        $id = count(User::all()) + 2;
        $user = $this->userRepo->create($id, [
            'name' => '',
            'email' => 'no email',
            'password' => 'password',
            'active' => 1
        ]);
    }
}
