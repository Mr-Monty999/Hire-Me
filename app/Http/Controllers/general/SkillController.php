<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillStoreRequest;
use App\Models\Profile;
use App\Models\Skill;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Skill::with("profiles")->get();
        return ResponseService::json($data, "تم جلب البيانات بنجاح");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkillStoreRequest $request)
    {
        $request->validated();
        $data = $request->all();

        $skill = Skill::where("name", $data["name"])->first();

        if ($skill == null)
            $skill = Skill::create($data);

        $skill->profiles()->syncWithoutDetaching($data["profile_id"]);


        return ResponseService::json($skill, "تم إضافة المهارة بنجاح");
    }
    public function detach($profileId, $skillId)
    {
        $skill = Skill::find($skillId);
        $skill->profiles()->detach($profileId);

        return ResponseService::json($skill, "تم حذف المهارة بنجاح");
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        return ResponseService::json($skill, "تم عرض المهارة بنجاح");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return ResponseService::json($skill, "تم حذف المهارة بنجاح");
    }
}
