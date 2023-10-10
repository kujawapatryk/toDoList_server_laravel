<?php

namespace  App\Repositories;

use App\Http\Requests\AddTaskRequest;
use App\Models\Task;
use Illuminate\Support\Collection;

class TaskRepository implements TaskRepositoryInterface {
    public function getAllTasks(): Collection
    {
        return Task::all();
    }

    public function createTask(AddTaskRequest $data): Task
    {
        $task = new Task();
        $task->done = $data['done'] ? $data['done'] : false;
        $task->content = $data['content'];
        $task->save();
        return $task;
    }

    public function updateTask(Task $task, bool $done): bool
    {
        return $task->update(['done' => $done]);
    }

    public function deleteTask(Task $task): bool
    {
        return $task->delete();
    }
}
