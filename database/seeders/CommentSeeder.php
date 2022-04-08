<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        for($i=0; $i < 50; $i++){ 
            for($j=0; $j < 4; $j++){ 
                # code...
                DB::table('comment')->insert([
                    'post_id' => $i,
                    'content'=> $faker->text,
                    'author'=> $faker->name,
                ]);
            }
        }
    }
}
