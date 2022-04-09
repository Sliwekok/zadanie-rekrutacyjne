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

class AddComment implements ShouldQueue
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
        // create faker instance
        $faker = Faker::create();
        // get all posts and pick random id from it
        $posts = $this->fetchPosts();
        // get random post 
        $randomPost = $posts[ rand(1, count($posts)) ];
        $id = $randomPost->id;
        // send request to API with random comment
        $url = $this->url . "post/$id/comment";
        $client = new \GuzzleHttp\Client();
        $client->request("POST", $url, [
            'form_params' => array(
                    'post_id'   => $id,
                    'content'   => $faker->text,
                    'author'    => $faker->name,
            )
        ]);
    }

    // fetch all posts from api
    private function fetchPosts(){
        $url = $this->url . "post/";
        $client = new \GuzzleHttp\Client();
        $response = $client->request("GET", $url);
        $posts = json_decode($response->getBody());
        return $posts;
    }
        
}
