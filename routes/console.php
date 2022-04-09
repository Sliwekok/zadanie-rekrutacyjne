<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

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

// create user command
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

// api calls counter
Artisan::command('apiCounter', function(){
    // find file
    $logFile = storage_path("logs/api.log");
    if(File::exists($logFile)){
        // open file and read untill eof
        $file = fopen($logFile, 'r');
        // go back by 13 hours and 33 minuts
        $pastTime = Carbon::parse(Carbon::now()->subMinutes(33)->subHours(13)->format('Y-m-d H:i:s'));
        dd(Carbon::now());
        $total = 0;
        while(!feof($file)){
            // transform line to json format
            $line = fgets($file);
            $json = json_decode($line, true);
            $req = Carbon::parse($json['time']);
            // check if current line timestamp is between now or past time and increment the total number of requests
            if($req->greaterThan($pastTime)) $total++;
        }
        $this->info("Total requests done in 13 hours 33 minutes time is: $total");
    }
});