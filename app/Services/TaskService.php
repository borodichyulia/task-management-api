<?php

namespace App\Services;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class TaskService
{
    public function getUserTasks(Request $request): Collection
    {
        Log::info('Attempting to get user tasks.');
        Gate::authorize('viewAny', Task::class);
        return $request->user()->tasks()->get();
    }

    public function createTask(TaskRequest $request): Task
    {
        Log::info('Creating new task to start.');
        return $request->user()->tasks()->create($request->validated());
    }

    public function getTask(Task $task): Task
    {
        Log::info('Getting task.');
        return $task;
    }

    public function updateTask(TaskRequest $request, Task $task): Task
    {
        Log::info('Updating task.');
        Gate::authorize('update', $task);
        $task->update($request->validated());
        return $task->fresh();
    }

    public function deleteTask(Task $task): bool
    {
        Log::info('Deleting task.');
        Gate::authorize('delete', $task);
        return $task->delete();
    }
}
