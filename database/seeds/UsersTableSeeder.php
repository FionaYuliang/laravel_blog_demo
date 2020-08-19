<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =  factory('App\User',5)->create([
            'password' => bcrypt('123456')
        ]);
    }
}
