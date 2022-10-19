<?php

namespace Database\Seeders;

use App\Models\Job;
use DB;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("jobs")->delete();

        Job::factory(20)->create();
    }
}
