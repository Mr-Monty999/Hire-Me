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

        User::each(function ($row) {
            $ids = Skill::pluck("id")->toArray();
            if (array_search($row->id, $ids) < 0)
                $row->skills()->attach($ids);
        }, User::count());
    }
}
