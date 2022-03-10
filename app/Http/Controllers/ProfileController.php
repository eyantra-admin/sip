<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

use App\Model\OnlineProfile;
use App\Model\CollegeDetails;
use App\Model\ElsiDepartments;
use App\Model\ElsiDesignations;
use App\Model\ExperienceDtls;
use App\Model\StudentProjDtls;
use App\Model\skills_list;
use App\User;

use Auth;
use Validator;
use Session;
use DateTime;
use Mail;
use Log;
use DB;
use Storage;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;



class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $colleges = CollegeDetails::select('clg_code','college_name')->orderBy('college_name')->get();
        $departments = ElsiDepartments::select('id', 'name')->orderBy('name')->get();
        $skills = skills_list::orderBy('skill')->get();
        $chksubmitted = User::where('email',Auth::user()->email)->first();
        $data = OnlineProfile:: where('email', Auth::user()->email)->first();
        $exp = ExperienceDtls::where('userid',Auth::user()->id)->get();
        $project = StudentProjDtls::where('userid',Auth::user()->id)->get();
        log::info($data);
        return view('profile.edit')
                ->with('colleges', $colleges)
                ->with('departments',$departments)
                ->with('skills', $skills)
                ->with('data', $data)
                ->with('exp', $exp)
                ->with('project', $project)
                ->with('form_submitted', $chksubmitted->profilesubmitted);
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

    public function updateSectionData(Request $request) // General section update
    {
        $profile = OnlineProfile::find(Auth::user()->id);
        $updates = $request->all();
        $profile->update($updates);   // save the updated data
        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function updateSection4(Request $request) //MOOC Corses update
    {
        log::info($request->all());
        $exp_dtls = new ExperienceDtls; 

        // ExperienceDtls::where('userid', Auth::user()->id)->delete();
        // $expvalue=$request->expdtl[0];
        // $exp=$request->expdtl;
        // if(!empty($expvalue))
        // {
        //     foreach($exp as $exp)
        //     {   
        //         if(!empty($exp))
        //         {
        //             log::info('**********************');
        //             $exp_dtls = new ExperienceDtls;             
        //             $exp_dtls->exp_description = $exp;
        //             $exp_dtls->userid = Auth::user()->id;   
        //             if(!$exp_dtls->save())
        //             {
        //                 throw new Exception('Unable to save your data.');
        //             }
        //         }                                   
        //     }               
        // }
        $rowid = ExperienceDtls::where('userid', Auth::user()->id)->pluck('id');
        log::info($rowid);
        for($i=0; $i < count($request['expdtl']); ++$i) 
        {
            $update_exp = DB::table('experience_dtls')
          ->where('id', $rowid[$i])
          ->update(['exp_description' => $request['expdtl'][$i]]);
        }                                   
        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function updateproj(Request $request) //Projects update
    {
        log::info($request->all());
        for($i=0; $i < count($request['projectTitle']); ++$i) 
        {
            log::info('------------------------');
            $rowid = StudentProjDtls::where('userid', Auth::user()->id)->pluck('id');
            log::info($rowid);
            $update_proj = DB::table('student_project_dtls')
            ->where('id', $rowid[$i])
            ->update([
                'projectTitle' => $request['projectTitle'][$i],
                'projDesc'=> $request['projDesc'][$i],
                'projDuration'=> $request['projDuration'][$i],
                'projMembers' => $request['projMembers'][$i],
                'projectRole'=> $request['projectRole'][$i],
                'projGithub'=> $request['projGithub'][$i],
                'projPubl' => $request['projPubl'][$i],
                'skills1'=> $request['skills1'][$i],
                'rating1'=> $request['rating1'][$i],
                'skills2'=> $request['skills2'][$i],
                'rating2'=> $request['rating2'][$i],
                'skills3'=> $request['skills3'][$i],
                'rating3'=> $request['rating3'][$i]
            ]);  
        }
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
