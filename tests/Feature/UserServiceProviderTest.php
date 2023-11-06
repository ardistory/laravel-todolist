<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceProviderTest extends TestCase
{
    private UserService $userService;
    protected function setUp()
    {
        parent::setUp();

        $this->userService = $this->app->make(UserService::class);
    }

    public function testLogin()
    {
        $this->assertTrue($this->userService->login('ardistory', 'rahasia123'));
    }

    public function testLoginError()
    {
        $this->assertFalse($this->userService->login('salah', 'salah'));
    }
}
