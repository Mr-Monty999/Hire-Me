<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            ProfileSeeder::class,
            ProfilePhoneSeeder::class,
            SkillSeeder::class,
            CertificateSeeder::class,
            CompanySeeder::class,
            CompanyPhoneSeeder::class,
            ExperienceSeeder::class,
            TagSeeder::class,
            CertificateSeeder::class,
            CommentSeeder::class,
            PostSeeder::class,
            // NotificationSeeder::class
        ]);
    }
}
