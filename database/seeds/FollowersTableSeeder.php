<?php

use Illuminate\Database\Seeder;
use App\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        //獲取去除掉id為1的所有用戶 id array
        $followers = $users->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();

        //關注除了1號用戶以外的所有用戶
        $user->follow($follower_ids);

        //除了1號用戶以外的所有用戶都來關注1號用戶
        foreach($followers as $follower){
          $follower->follow($user_id);
        }
    }
}
