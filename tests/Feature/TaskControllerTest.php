<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_tasks()
    {
        Task::factory()->count(5)->create();
        $response = $this->get('/api/tasks');
        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    public function test_can_store_task()
    {
        $data = [
            'content' => 'Test Task',
            'done' => true
        ];
        $response = $this->post('/api/tasks', $data);
        $response->assertStatus(201);
        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_can_update_task()
    {
        $task = Task::factory()->create(['done' => false]);
        $data = ['done' => true];
        $response = $this->patch("/api/tasks/{$task->id}", $data);
        $response->assertStatus(200);
        $response->assertJson(['message' => 'taskConfirmation', 'status' => 'success']);
        $this->assertTrue((bool) Task::find($task->id)->done);
    }

    public function test_can_delete_task()
    {
        $task = Task::factory()->create();
        $response = $this->delete("/api/tasks/{$task->id}");
        $response->assertStatus(200);
        $response->assertJson(['message' => 'taskDeleted', 'status' => 'success']);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }


    public function test_cannot_update_non_existent_task()
    {
        $data = ['done' => true];
        $response = $this->patch("/api/tasks/9999", $data); // Assuming that ID 9999 does not exist.
        $response->assertStatus(404); // 404 Not Found
    }

    public function test_cannot_delete_non_existent_task()
    {
        $response = $this->delete("/api/tasks/9999"); // Assuming that ID 9999 does not exist.
        $response->assertStatus(404); // 404 Not Found
    }
}

