<?php

use Illuminate\Database\Seeder;

class PostTopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts  =  factory('App\PostTopic',8)->create([
            'topic_id'=>1,
        ]);
    }
}
