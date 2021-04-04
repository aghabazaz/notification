<?php

namespace App\Jobs;

use App\Services\Notification\Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $user;
    private $text;
    public function __construct(User $user,String $text)
    {
        $this->user=$user;
        $this->text=$text;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Notification $notification)
    {
        $notification->sendSms($this->user,$this->text);
    }
}
