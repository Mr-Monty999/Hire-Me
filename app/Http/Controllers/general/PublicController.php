<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Services\PublicService;
use App\Services\ResponseService;
use Illuminate\Http\Request;

class PublicController extends Controller
{

    public function search($pattern)
    {
        $result = PublicService::search($pattern);
        return ResponseService::json($result, "تم جلب البيانات بنجاح");
    }
}
