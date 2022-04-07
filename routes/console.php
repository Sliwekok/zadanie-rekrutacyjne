<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('createUser', function(){
    $name       = $this->ask("Username");
    $email      = $this->ask("Email");
    $password   = $this->secret("Password");

    if($this->confirm("Do you confirm this data? \n Username: $name \n Email: $email", true)){
        User::query()->create([
            'name'      => $name,
            'email'     => $email,
            'password'  => Hash::make($password),
        ]);
        $this->info("Account created for $name");
    }
});
