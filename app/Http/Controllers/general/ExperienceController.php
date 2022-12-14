<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExperienceStoreRequest;
use App\Http\Requests\ExperienceUpdateRequest;
use App\Models\Company;
use App\Models\Experience;
use App\Services\ExperienceService;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware("permission:create-experiences|create-any-experiences")->only(["store"]);
        $this->middleware("permission:view-experiences|view-any-experiences")->only(["index", "show"]);
        $this->middleware("permission:edit-experiences|edit-any-experiences")->only(["update"]);
        $this->middleware("permission:delete-experiences|delete-any-experiences")->only(["destroy"]);
    }

    public function index()
    {

        $data = Experience::with("phones", "skills", "experiences", "posts")->get();
        return ResponseService::json($data, "تم جلب البيانات بنجاح");
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
    public function store(ExperienceStoreRequest $request)
    {
        $ex =  ExperienceService::store($request->all());
        return ResponseService::json($ex, "تم إضافة الخبرة بنجاح", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function show(Experience $experience)
    {
        return ResponseService::json($experience, "تم جلب الخبرة بنجاح");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function update(ExperienceUpdateRequest $request, Experience $experience)
    {
        ExperienceService::update($request->all(), $experience);

        return ResponseService::json($experience, "تم تعديل البيانات بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Experience  $experience
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experience $experience)
    {
        ExperienceService::forceDelete($experience);
        return ResponseService::json($experience, "تم حذف البيانات بنجاح");
    }
}
