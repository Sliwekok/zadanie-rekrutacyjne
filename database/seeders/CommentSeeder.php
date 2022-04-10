<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use Illuminate\Database\Facades\Str;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        // start from first post
        for($i=1; $i < 50; $i++){ 
            for($j=0; $j < 4; $j++){ 
                $comment = new Comment;
                // pass data
                $comment->author   = $faker->name;
                $comment->post_id  = $i;
                $comment->content  = $faker->text;
                // save in db
                $comment->save();
            }
        }
    }
}
