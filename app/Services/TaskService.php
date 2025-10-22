<?php

namespace App\Services;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskService
{
    public function getUserTasks(Request $request): Collection
    {
        Gate::authorize('viewAny', Task::class);
        return $request->user()->tasks()->get();
    }

    public function createTask(TaskRequest $request): Task
    {
        return $request->user()->tasks()->create($request->validated());
    }

    public function getTask(Task $task): Task
    {
        return $task;
    }

    public function updateTask(TaskRequest $request, Task $task): Task
    {
        Gate::authorize('update', $task);
        $task->update($request->validated());
        return $task->fresh();
    }

    public function deleteTask(Task $task): bool
    {
        Gate::authorize('delete', $task);
        return $task->delete();
    }
}
