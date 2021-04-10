<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Log;
use App\Model\OnlineProfile;
use App\Model\CollegeDetails;
use App\Model\ElsiDepartments;
use App\Model\ElsiDesignations;
use App\Model\ExperienceDtls;
use App\Model\StudentProjDtls;
use App\Model\skills_list;
use Request;
use Illuminate\Support\Facades\Input;


class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Show the form for changing password.
     *
     * @return \Illuminate\View\View
     */
    public function changepassword()
    {
        return view('profile.changepassword');
    }

    public function studentprofile()
    {
        $colleges = CollegeDetails::select('clg_code','college_name')->orderBy('college_name')->get();
        $departments = ElsiDepartments::select('id', 'name')->orderBy('name')->get();
        $skills = skills_list::orderBy('skill')->get();
        $country = CollegeDetails::select('country')->orderBy('country')->distinct()->get();

        $department = ElsiDepartments::select('id', 'name')->orderBy('name')->get();

        $designation = ElsiDesignations::select('id', 'name')->orderBy('name')->get();
        //log::info($skills);

        return view('profile.studentprofile')
                ->with('colleges', $colleges)
                ->with('department',$department)
                ->with('skills', $skills)
                ->with('designation',$designation)
                ->with('country', $country);
       
    }
    public function submitform()
    {
        log::info('submit form is here');
    }



    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('Password successfully updated.'));
    }














}
