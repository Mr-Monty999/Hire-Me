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
use Illuminate\Support\Facades\Response;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $jobs = JobService::getAllJobs();
        return ResponseService::json($jobs, "تم جلب جميع المنشورات بنجاح");
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
        $data["profile_id"] = Auth::user()->profile->id;
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
    public function show(Job $job)
    {
        //
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
        $data["profile_id"] = Auth::user()->profile->id;
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
        $job->delete();
        return  ResponseService::json($job);
    }
}
