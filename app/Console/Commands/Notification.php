<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyEmail;

class Notification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email notification to users daily';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $emails = User::pluck('email')->toArray();
        $data = ['title'=>'programming','body'=>'php'];
        foreach($emails as $email){
            Mail::to($email)->send(new NotifyEmail($data));
        }
    }
}
