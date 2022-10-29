<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Models\Job;
use App\Services\JobService;
use App\Services\NotificationService;
use App\Services\ResponseService;
use Auth;
use Gate;
use Illuminate\Support\Facades\Response;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware("permission:create-jobs|create-any-jobs")->only(["store"]);
        $this->middleware("permission:view-jobs|view-any-jobs")->only(["index", "show"]);
        $this->middleware("permission:edit-jobs|edit-any-jobs")->only(["update"]);
        $this->middleware("permission:delete-jobs|delete-any-jobs")->only(["destroy"]);
    }

    public function index()
    {

        $jobs = JobService::getAllJobs();
        return ResponseService::json($jobs, "تم جلب جميع المنشورات بنجاح");
    }

    public function search($pattern)
    {
        $searched = JobService::searchForJob($pattern);
        return ResponseService::json($searched);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreJobRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJobRequest $request)
    {
        $data = $request->all();
        $data["user_id"] = Auth::id();
        $data = JobService::store($data);
        $data["job_id"] = $data["id"];
        NotificationService::sendOfferJobNotification($data);
        return ResponseService::json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show($job)
    {
        $job = JobService::show($job);

        return  ResponseService::json($job);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJobRequest  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobRequest $request, Job $job)
    {
        $data = $request->all();
        $data["user_id"] = Auth::user()->id;
        $data = JobService::update($job, $data);
        return  ResponseService::json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        JobService::forceDelete($job);
        return  ResponseService::json($job);
    }
}
