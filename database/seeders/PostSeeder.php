<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 50; $i++){ 
            $post = new Post;
            // pass data
            $post->author   = $faker->name;
            $post->title    = Str::random(15);
            $post->content  = $faker->text;
            // save in db
            $post->save();
        }
    }
}
