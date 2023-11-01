<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class createUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $name=$this->ask('What is your name?');
        $email=$this->ask('What is your email?');
        $phone=$this->ask('What is your phone number?');
        $password=$this->secret('Provide a password');

        $user=User::where('email', $email)->first();
        if ($user){
            die('User already exists under the same email');
        }

        User::create([
            'name'=>$name,
            'email'=>$email,
            'cellphone'=>$phone,
            'password'=>Hash::make($password)
        ]);
        $this->info('User has been successfully created');
    }
}
