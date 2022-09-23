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

        Profile::each(function ($row) {
            $ids = Profile::pluck("id")->toArray();

            if (array_search($row->id, $ids) < 0) {
                $row->followings()->attach($ids);
                $row->followers()->attach($ids);
            }
        }, Profile::count());
    }
}
