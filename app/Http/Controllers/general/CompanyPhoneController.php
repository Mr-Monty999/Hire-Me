<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\CompanyPhone;
use Illuminate\Http\Request;

class CompanyPhoneController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:create-companies-phones|create-any-companies-phones")->only(["store"]);
        $this->middleware("permission:view-companies-phones|view-any-companies-phones")->only(["index", "show"]);
        $this->middleware("permission:edit-companies-phones|edit-any-companies-phones")->only(["update"]);
        $this->middleware("permission:delete-companies-phones|delete-any-companies-phones")->only(["destroy"]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyPhone  $companyPhone
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyPhone $companyPhone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyPhone  $companyPhone
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyPhone  $companyPhone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyPhone $companyPhone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyPhone  $companyPhone
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyPhone $companyPhone)
    {
        //
    }
}
