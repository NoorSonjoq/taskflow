<?php

namespace App\Console\Commands;

use App\Mail\TaskDueReminder;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendTaskReminders extends Command
{
    protected $signature = 'app:send-task-reminders';

    protected $description = 'إرسال تذكير بالإيميل للمهام المستحقة أو المتأخرة';

    public function handle(): void
    {
        // المستخدمين اللي عندهم مهام مستحقة (اليوم أو متأخرة) وغير مكتملة
        $users = User::whereHas('tasks', function ($query) {
            $query->whereDate('due_date', '<=', today())
                  ->where('status', '!=', 'done');
        })->get();

        foreach ($users as $user) {
            $tasks = $user->tasks()
                ->whereDate('due_date', '<=', today())
                ->where('status', '!=', 'done')
                ->get();

            Mail::to($user->email)->send(new TaskDueReminder($user, $tasks));
            $this->info("تم إرسال تذكير لـ {$user->email} ({$tasks->count()} مهمة)");
        }

        $this->info('خلص إرسال التذكيرات.');
    }
}
