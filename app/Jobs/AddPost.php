<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AddPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $url;    
    public function __construct(){
        $this->url = 'http://zadanie.test/api/';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $faker = Faker::create();

        $url = $this->url . "post/create";
        $client = new \GuzzleHttp\Client();
        $client->request("POST", $url, [
            'form_params' => array(
                'title'     => Str::random(15),
                'content'   => $faker->text,
                'author'    => $faker->name,
            )
        ]);
    }
}
