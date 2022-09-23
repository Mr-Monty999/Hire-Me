<?php

namespace Database\Seeders;

use App\Models\Experience;
use DB;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("experiences")->delete();

        Experience::factory(30)->create();
    }
}
