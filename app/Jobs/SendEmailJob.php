<?php

namespace App\Jobs;

use App\Models\EmailLog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email, $subject, $message;

    public function __construct($email, $subject, $message) {
        $this->email = $email;
        $this->subject = $subject;
        $this->message = $message;
    }

    public function handle() {
        try {
            Mail::raw($this->message, function ($mail) {
                $mail->to($this->email)
                     ->subject($this->subject);
            });

            EmailLog::create(['email' => $this->email, 'status' => 'sent']);
        } catch (\Exception $e) {
            EmailLog::create([
                'email' => $this->email,
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }
}
