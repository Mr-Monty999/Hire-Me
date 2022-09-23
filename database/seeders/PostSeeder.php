<?php

namespace Database\Seeders;

use App\Models\Post;
use DB;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("posts")->delete();

        Post::factory(30)->create();
    }
}
