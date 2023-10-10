<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AddTaskRequest;
use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TaskController extends Controller
{
    private TaskRepositoryInterface $repository;
    public function __construct(TaskRepositoryInterface $repository){
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return $this->repository->getAllTasks();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddTaskRequest $request): Task
    {
        return $this->repository->createTask($request);
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
    public function update(Request $request, Task $task): JsonResponse
    {

        $result = $this->repository->updateTask($task, $request['done']);

        return $result
            ? response()->json(['message' => 'taskConfirmation', 'status' => 'success'], ResponseAlias::HTTP_OK)
            : response()->json(['message' => 'tryLater', 'status' => 'fail'], ResponseAlias::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): JsonResponse
    {
        $result = $this->repository->deleteTask($task);
        return $result
            ? response()->json(['message' => 'taskDeleted', 'status' => 'success'], ResponseAlias::HTTP_OK)
            : response()->json(['message' => 'tryLater', 'status' => 'fail'], ResponseAlias::HTTP_BAD_REQUEST);
    }
}
