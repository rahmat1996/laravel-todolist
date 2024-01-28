<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    public function testTodolist()
    {
        $this->withSession([
            "user" => "rahmat",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Belajar Laravel Dasar"
                ],
                [
                    "id" => "2",
                    "todo" => "Belajar Laravel Menegah"
                ],
                [
                    "id" => "3",
                    "todo" => "Belajar Laravel Mahir"
                ]
            ]
        ])->get("/todolist")
            ->assertSeeText("1")
            ->assertSeeText("Belajar Laravel Dasar")
            ->assertSeeText("2")
            ->assertSeeText("Belajar Laravel Menegah")
            ->assertSeeText("3")
            ->assertSeeText("Belajar Laravel Mahir");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "rahmat"
        ])->post("/todolist", [])
            ->assertSeeText("Todo is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "rahmat"
        ])->post("/todolist", [
            "todo" => "Belajar Laravel Dasar"
        ])->assertRedirect("/todolist");
    }

    public function testRemoveTodolist(){
        $this->withSession([
            "user" => "rahmat",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Belajar Laravel Dasar"
                ],
                [
                    "id" => "2",
                    "todo" => "Belajar Laravel Menegah"
                ],
                [
                    "id" => "3",
                    "todo" => "Belajar Laravel Mahir"
                ]
            ]
        ])->post("/todolist/1/delete")
        ->assertRedirect("/todolist");
    }
}
