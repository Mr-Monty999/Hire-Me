<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("skills")->delete();
        Skill::factory(10)->create();

        foreach (User::all() as $key => $row) {
            $ids = Skill::pluck("id")->toArray();
            foreach ($ids as $key => $value)
                $ids[$value] = ["created_at" => now(), "updated_at" => now()];
            $row->skills()->sync($ids);
        }
    }
}
