<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class Expiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expire users every 5 minute automatically';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('expire',null)->get();
        // dd($users);
        foreach($users as $user){
            $user->update([
                'expire'=> '1'
            ]);
        }
    }
}
