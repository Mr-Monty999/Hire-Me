<?php

namespace App\Services;

use App\Models\Company;
use App\Models\Experience;
use Gate;

/**
 * Class ExperienceService.
 */
class ExperienceService
{

    public static function store($data)
    {

        $company = Company::where("name", $data["company_name"])->first();

        if ($company != null)
            $data["company_id"] = $company->id;

        $ex =   Experience::create($data);
        return $ex;
    }

    public static function update($data, $experience)
    {
        Gate::authorize("update", $experience);
        $experience->update($data);
        return $experience;
    }
    public static function forceDelete($experience)
    {
        Gate::authorize("forceDelete", $experience);
        $experience->delete();
        return $experience;
    }
}
