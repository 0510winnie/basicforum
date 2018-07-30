<?php

use App\User;
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
        User::create([
            'name' => 'Luna',
            'email' => '0510winnie@gmail.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
