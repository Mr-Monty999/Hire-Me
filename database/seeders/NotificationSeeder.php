<?php

namespace Database\Seeders;

use App\Models\Notification;
use DB;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table("notifications")->delete();

        // Notification::factory(50)->create();
    }
}
