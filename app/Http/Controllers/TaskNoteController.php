<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskNoteRequest;
use App\Models\Task;
use App\Models\TaskNote;

class TaskNoteController extends Controller
{
    // إضافة ملاحظة على مهمة
    public function store(StoreTaskNoteRequest $request, Task $task)
    {
        // فقط صاحب المهمة يقدر يضيف عليها ملاحظات
        $this->authorize('update', $task);

        $task->notes()->create([
            'user_id' => $request->user()->id,
            'body'    => $request->validated('body'),
        ]);

        return back()->with('success', __('تمت إضافة الملاحظة.'));
    }

    // حذف ملاحظة
    public function destroy(Task $task, TaskNote $note)
    {
        $this->authorize('update', $task);

        // نتأكد إنو الملاحظة تابعة فعلاً لهاي المهمة
        abort_unless($note->task_id === $task->id, 404);

        $note->delete();

        return back()->with('success', __('تم حذف الملاحظة.'));
    }
}
