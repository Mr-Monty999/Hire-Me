<?php

namespace App\Services;

use App\Models\Job;
use App\Models\Profile;

/**
 * Class JobService.
 */
class JobService
{
    public static function show($jobId)
    {
        $job = Job::with("profile:id,firstname,lastname,avatar")->find($jobId);
        return $job;
    }

    public static function store($data)
    {
        $job =  Job::create($data);
        $job = Job::find($job->id);

        return $job;
    }
    public static function update($job, $data)
    {
        $job->update($data);

        return $job;
    }

    public static function getAllJobs()
    {
        $jobs = Job::with([
            "profile:id,firstname,lastname,avatar",
        ])->latest()->paginate(5);

        foreach ($jobs as  $job) {
            $job->created_at_diff_for_humans = $job->created_at->diffForHumans();
        }

        return $jobs;
    }
}
