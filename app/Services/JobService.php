<?php

namespace App\Services;

use App\Models\Job;

/**
 * Class JobService.
 */
class JobService
{

    public static function store($data)
    {
        $job =  Job::create($data);
        return $job;
    }
    public static function update($job, $data)
    {
        $job->update($data);

        return $job;
    }
}
