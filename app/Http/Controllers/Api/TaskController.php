<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AddTaskRequest;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return Task::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddTaskRequest $request): void
    {
        $task = new Task();
        $task->done = $request['done'] ? $request['done'] : false;
        $task->content = $request['content'];
        $task->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $task->update(['done' => $request['done']]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): void
    {
        $task->delete();
    }
}
