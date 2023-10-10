<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\AddTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class TaskRequestTest extends TestCase
{
public function test_add_task_request_validation()
{
$request = new AddTaskRequest();

// Test content is required
$data = ['content' => ''];
$validator = Validator::make($data, $request->rules());
$this->assertFalse($validator->passes());

// Test content is string
$data = ['content' => 123];
$validator = Validator::make($data, $request->rules());
$this->assertFalse($validator->passes());

// Test content max length
$data = ['content' => str_repeat('a', 256)];
$validator = Validator::make($data, $request->rules());
$this->assertFalse($validator->passes());

// Test done is boolean
$data = ['content' => 'Test', 'done' => 'string'];
$validator = Validator::make($data, $request->rules());
$this->assertFalse($validator->passes());

// Test done is nullable
$data = ['content' => 'Test'];
$validator = Validator::make($data, $request->rules());
$this->assertTrue($validator->passes());
}

public function test_update_task_request_validation()
{
$request = new UpdateTaskRequest();

// Test done is required
$data = [];
$validator = Validator::make($data, $request->rules());
$this->assertFalse($validator->passes());

// Test done is boolean
$data = ['done' => 'string'];
$validator = Validator::make($data, $request->rules());
$this->assertFalse($validator->passes());
}
}
