<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks()->with('project')->latest()->get();

        return response()->json($tasks);
    }

    public function store(StoreTaskRequest $request)
    {
        $project = $request->user()->projects()->findOrFail($request->project_id);

        $task = $project->tasks()->create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);

        return response()->json($task, 201);
    }
}