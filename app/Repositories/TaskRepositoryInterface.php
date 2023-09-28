<?php

namespace App\Repositories;

use App\Http\Requests\AddTaskRequest;
use App\Models\Task;
use Illuminate\Support\Collection;

interface TaskRepositoryInterface{
    public function getAllTasks(): Collection;
    public function createTask(AddTaskRequest $data): Task;
    public function updateTask(Task $task, bool $done): bool;
    public function deleteTask(Task $task): bool;

}
