<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table("users")->delete();

        DB::table("user_follow")->delete();
        DB::table("user_skill")->delete();

        User::factory(10)->create();


        $ids = User::pluck("id")->toArray();
        $connectionIds = $ids;
        foreach ($ids as $key => $value) {
            $ids[$value] =  ["created_at" => now(), "updated_at" => now()];
            $connectionIds[$value] = ["accepted" => false];
        }

        foreach (User::all() as $key => $row) {
            $row->followings()->syncWithoutDetaching($ids);
            $row->followers()->syncWithoutDetaching($ids);
            $row->connectionsTo()->syncWithoutDetaching($connectionIds);
            $row->connectionsFrom()->syncWithoutDetaching($connectionIds);
        }
    }
}
