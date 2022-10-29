<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\SkillStoreRequest;
use App\Models\User;
use App\Models\Skill;
use App\Services\ResponseService;
use Auth;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware("permission:create-skills|create-any-skills")->only(["store"]);
        $this->middleware("permission:view-skills|view-any-skills")->only(["index", "show"]);
        $this->middleware("permission:edit-skills|edit-any-skills")->only(["update"]);
        $this->middleware("permission:delete-skills|delete-any-skills")->only(["destroy"]);
    }
    public function index()
    {

        $data = Skill::with("users")->get();
        return ResponseService::json($data, "تم جلب البيانات بنجاح");
    }

    public function search($skillName)
    {
        $skills = Skill::where("name", "LIKE", "%$skillName%")->limit(10)->get();
        return ResponseService::json($skills, "تم جلب البيانات بنجاح");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $skill->users()->syncWithoutDetaching($data["user_id"]);


        return ResponseService::json($skill, "تم إضافة المهارة بنجاح", 201);
    }
    public function detach($skillId)
    {

        $skill = Skill::find($skillId);
        $skill->users()->detach(Auth::id());

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

        // $skill = $skill->with("users")->get();

        return ResponseService::json($skill, "تم عرض المهارة بنجاح");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */

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
