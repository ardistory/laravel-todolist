<?php

namespace Tests\Feature;

use App\Services\TodoListService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListServiceProviderTest extends TestCase
{
    private TodoListService $todoListService;

    public function setUp()
    {
        parent::setUp();

        $this->todoListService = $this->app->make(TodoListService::class);
    }

    public function testTodoListServiceProviderNotNull()
    {
        $this->assertNotNull($this->todoListService);
    }
}
