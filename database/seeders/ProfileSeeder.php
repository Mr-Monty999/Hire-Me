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
        Profile::factory(10)->create();
    }
}
