<?php

namespace Database\Seeders;

use App\Models\Profile;

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

        foreach (Profile::all() as $key => $row) {
            # code...
            $ids = Profile::pluck("id")->toArray();
            foreach ($ids as $key => $value)
                $ids[$value] =  ["created_at" => now(), "updated_at" => now()];
            $row->followings()->sync($ids);
            $row->followers()->sync($ids);
        }
    }
}
