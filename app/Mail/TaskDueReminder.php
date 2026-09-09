<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TaskDueReminder extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user, public $tasks) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'تذكير: عندك مهام مستحقة');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.task-reminder');
    }
}