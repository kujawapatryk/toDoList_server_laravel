<?php

namespace Database\Factories;

use App\Http\Requests\AddTaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'content' => $this->faker->sentence,
            'done' => $this->faker->boolean,
        ];
    }
}
