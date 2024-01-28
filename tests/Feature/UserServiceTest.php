<?php

namespace Tests\Feature;

use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    protected function setUp(): void
    {
        parent::setUp();
        $this->userService = $this->app->make(UserService::class);
    }

    public function testSample()
    {
        $this->assertTrue(true);
    }

    public function testLoginSuccess()
    {
        $this->assertTrue($this->userService->login("rahmat", "12345"));
    }

    public function testLoginUserNotFound()
    {
        $this->assertFalse($this->userService->login("budi", "12345"));
    }

    public function testLoginWrongPassword()
    {
        $this->assertFalse($this->userService->login("rahmat", "meong"));
    }
}
