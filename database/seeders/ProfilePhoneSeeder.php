<?php

namespace Database\Seeders;

use App\Models\ProfilePhone;
use DB;
use Illuminate\Database\Seeder;

class ProfilePhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("profile_phones")->delete();

        ProfilePhone::factory(30)->create();
    }
}
