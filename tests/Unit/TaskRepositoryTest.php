<?php

namespace Tests\Unit;

use App\Http\Requests\AddTaskRequest;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected TaskRepository $taskRepo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->taskRepo = new TaskRepository();
    }

    public function test_can_get_all_tasks()
    {
        Task::factory()->count(5)->create();
        $tasks = $this->taskRepo->getAllTasks();
        $this->assertCount(5, $tasks);
    }

    public function test_can_create_task()
    {
        $request = new AddTaskRequest();
        $request->merge([
            'content' => 'Test Task',
            'done' => true
        ]);
        $task = $this->taskRepo->createTask($request);
        $this->assertInstanceOf(Task::class, $task);
        $this->assertEquals('Test Task', $task->content);
        $this->assertTrue($task->done);
    }

    public function test_can_update_task()
    {
        $task = Task::factory()->create(['done' => false]);
        $updated = $this->taskRepo->updateTask($task, true);
        $this->assertTrue($updated);
        $this->assertTrue((bool) $task->fresh()->done);
    }

    public function test_can_delete_task()
    {
        $task = Task::factory()->create();
        $deleted = $this->taskRepo->deleteTask($task);
        $this->assertTrue($deleted);
        $this->assertNull(Task::find($task->id));
    }
}
