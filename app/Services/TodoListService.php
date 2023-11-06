<?php

namespace App\Services;

interface TodoListService
{
    public function saveTodo(string $id, string $todo): void;

    public function getTodo(): array;

    public function delTodo(string $id): void;
}