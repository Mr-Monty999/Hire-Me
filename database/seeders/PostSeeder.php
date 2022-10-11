<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Profile;
use App\Notifications\ReactToPostNotification;
use DB;
use Illuminate\Database\Seeder;
use Notification;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("posts")->delete();
        DB::table("post_react")->delete();

        Post::factory(30)->create();

        $ids = Profile::pluck("id")->toArray();
        foreach ($ids as $key => $value)
            $ids[$value] =  ["type" => 1];


        foreach (Post::all() as $key => $row) {

            $row->reacts()->syncWithoutDetaching($ids);
            // $row->profile->notify(new ReactToPostNotification(["react_type" => 1, "post_id" => $row->id], "profile_id"=));
        }
    }
}
