<?php

namespace Tests\Feature;

use App\Services\TodolistService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function testTodolistNotNull()
    {
        $this->assertNotNull($this->todolistService);
    }

    public function testSaveTodo()
    {
        $this->todolistService->saveTodo("1", "Belajar Laravel Dasar");
        $todolist = Session::get("todolist");
        foreach ($todolist as $value) {
            $this->assertEquals("1", $value['id']);
            $this->assertEquals("Belajar Laravel Dasar", $value['todo']);
        }
    }

    public function testGetTodolistEmpty()
    {
        $this->assertEquals([], $this->todolistService->getTodolist());
    }

    public function testGetTodolistNotEmpty()
    {
        $expected = [
            [
                "id" => "1",
                "todo" => "Belajar PHP"
            ],
            [
                "id" => "2",
                "todo" => "Belajar Laravel"
            ]
        ];

        $this->todolistService->saveTodo("1", "Belajar PHP");
        $this->todolistService->saveTodo("2", "Belajar Laravel");

        $this->assertEquals($expected, $this->todolistService->getTodolist());
    }

    public function testRemoveTodo()
    {
        $this->todolistService->saveTodo("1", "Belajar PHP");
        $this->todolistService->saveTodo("2", "Belajar Laravel");

        $this->assertEquals(2, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo("3");

        $this->assertEquals(2, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo("2");

        $this->assertEquals(1, sizeof($this->todolistService->getTodolist()));

        $this->todolistService->removeTodo("1");

        $this->assertEquals(0, sizeof($this->todolistService->getTodolist()));
    }
}
