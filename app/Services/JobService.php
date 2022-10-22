<?php

namespace App\Services;

use App\Models\Job;
use App\Models\User;
use Gate;

/**
 * Class JobService.
 */
class JobService
{
    public static function show($jobId)
    {
        $job = Job::with("user.profile")->find($jobId);
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
        Gate::authorize("update", $job);
        $job->update($data);

        return $job;
    }
    public static function forceDelete($job)
    {

        Gate::authorize("forceDelete", $job);
        $job->delete();
        return $job;
    }

    public static function getAllJobs()
    {
        $jobs = Job::with([
            "user:id,firstname,lastname,avatar",
        ])->latest()->paginate(5);

        foreach ($jobs as  $job) {
            $job->created_at_diff_for_humans = $job->created_at->diffForHumans();
        }

        return $jobs;
    }

    public static function searchForJob($pattern)
    {
        $pattern = trim($pattern);
        $result = Job::with("user:id,firstname,lastname,avatar")->where("title", "LIKE", "%$pattern%")
            ->orWhere("description", "LIKE", "%$pattern%")
            ->orWhere("location", "LIKE", "%$pattern%")
            ->latest()
            ->paginate(5);

        return $result;
    }
}
