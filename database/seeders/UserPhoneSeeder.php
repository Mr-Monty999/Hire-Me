<?php

namespace Database\Seeders;

use App\Models\Test;
use App\Models\User;
use App\Models\UserPhone;
use Database\Factories\TagFactory;
use Database\Factories\UserPhoneFactory;
use DB;
use Illuminate\Database\Seeder;

class UserPhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("user_phones")->delete();

        UserPhone::factory(30)->create();
    }
}
