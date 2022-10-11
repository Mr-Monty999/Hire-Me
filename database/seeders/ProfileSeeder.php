<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Profile;
use App\Services\ProfileService;
use Database\Factories\ProfileFactory;
use DB;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("profiles")->delete();
        DB::table("profile_follow")->delete();
        DB::table("profile_skill")->delete();

        Profile::factory(10)->create();

        $ids = Profile::pluck("id")->toArray();
        $connectionIds = $ids;
        foreach ($ids as $key => $value) {
            $ids[$value] =  ["created_at" => now(), "updated_at" => now()];
            $connectionIds[$value] = ["accepted" => false];
        }

        foreach (Profile::all() as $key => $row) {
            $row->followings()->syncWithoutDetaching($ids);
            $row->followers()->syncWithoutDetaching($ids);
            $row->connectionsTo()->syncWithoutDetaching($connectionIds);
            $row->connectionsFrom()->syncWithoutDetaching($connectionIds);
        }
    }
}
