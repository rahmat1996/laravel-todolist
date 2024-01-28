<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    public function testHomeGuest()
    {
        $this->get('/')
            ->assertRedirect('/login');
    }

    public function testHomeMember()
    {
        $this->withSession(['user' => "rahmat"])
            ->get('/')
            ->assertRedirect('/todolist');
    }
}
