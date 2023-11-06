<?php

namespace App\Http\Controllers;

use App\Services\TodoListService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoListController extends Controller
{
    private TodoListService $todoListService;

    public function __construct(TodoListService $todoListService)
    {
        $this->todoListService = $todoListService;
    }

    public function toDoList(Request $request): Response
    {
        $toDoList = $this->todoListService->getTodo();

        return response()->view('todolist.todolist', [
            'title' => 'ToDo List',
            'todolist' => $toDoList
        ]);
    }

    public function setToDo(Request $request)
    {
        $todo = $request->input('todo');

        if (empty($todo)) {
            $toDoList = $this->todoListService->getTodo();

            return response()->view('todolist.todolist', [
                'title' => 'ToDo List',
                'todolist' => $toDoList,
                'error' => 'Todo List dilarang kosong!'
            ]);
        }

        $this->todoListService->saveTodo(uniqid(), $todo);

        return redirect()->action([TodoListController::class, 'toDoList']);
    }

    public function delToDo(Request $request, string $id)
    {
        $this->todoListService->delTodo($id);

        return redirect()->action([TodoListController::class, 'toDoList']);
    }
}
