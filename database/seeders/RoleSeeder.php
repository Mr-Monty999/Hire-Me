<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\RoleService;
use DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("roles")->whereNotIn("name", ["owner", "user"])->delete();
        DB::table("model_has_roles")->delete();

        $users = User::all();
        foreach ($users as $user)
            $user->assignRole("user");
    }
}
