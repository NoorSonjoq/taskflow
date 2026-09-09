<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // الصفحة الشاملة — كل مهام المستخدم مع فلترة
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks()->with('project')->latest();

        if ($request->filled('status')) {
            $tasks->where('status', $request->status);
        }
        if ($request->filled('priority')) {
            $tasks->where('priority', $request->priority);
        }

        $tasks = $tasks->get();

        return view('tasks.index', compact('tasks'));
    }

    public function store(StoreTaskRequest $request)
    {
        // نتأكد إنه المشروع تبع المستخدم الحالي
        $project = $request->user()->projects()->findOrFail($request->project_id);

        $task = $project->tasks()->create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
        ]);

        return back()->with('success', 'تمت إضافة المهمة.');
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->update($request->validated());

        return back()->with('success', 'تم تحديث المهمة.');
    }

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return back()->with('success', 'تم حذف المهمة.');
    }
}