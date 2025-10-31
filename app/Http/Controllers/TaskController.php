<?php

namespace App\Http\Controllers;

use App\Constants\HttpStatuses;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService){
        $this->taskService = $taskService;
    }

    public function index(Request $request):TaskCollection
    {
        $tasks = $this->taskService->getUserTasks($request);
        return new TaskCollection($tasks);
    }

    public function store(TaskRequest $request)
    {
        $task = $this->taskService->createTask($request);
        return response()->json(new TaskResource($task), HttpStatuses::HTTP_CREATED);
    }

    public function show(Task $task): TaskResource
    {
        $task = $this->taskService->getTask($task);
        return new TaskResource($task);
    }

    public function update(TaskRequest $request, Task $task): TaskResource
    {
        $task = $this->taskService->updateTask($request, $task);
        return new TaskResource($task);
    }

    public function destroy(Task $task): JsonResponse
    {
        $this->taskService->deleteTask($task);
        return response()->json(null, HttpStatuses::HTTP_NO_CONTENT);
    }
}
