<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Facades\Str;
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
            DB::table('post')->insert([
                'title' => Str::random(15),
                'content'=> $faker->text,
                'author'=> $faker->name,
            ]);
        }
    }
}
