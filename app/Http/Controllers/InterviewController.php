<?php

namespace App\Http\Controllers;
use App\Model\OnlineProfile;
use App\Model\CollegeDetails;
use App\Model\ElsiState;
use App\Model\Projects;
use App\Model\StudentProjPrefer;
use App\User;
use App\Model\TimeslotBooking;
use App\Model\UserPanel;
use App\Model\EysipUploads;
use App\Model\PreInternshipSurvey;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Log;
use DB;
use Auth;
use Validator;
use Config;
use Storage;
use PDF;
use DataTables;

class InterviewController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $request;

    protected static $thisClass = 'HomeController';
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('auth');
    }

    public function Evaluation()
    {
        $todayDate = date("Y-m-d");
        log::info($todayDate);
        //get auth(logged in user) panel id
        $panel_no = UserPanel::where('userid', Auth::user()->id)->value('panelid');
        log::info($panel_no);
        //get all student user id's who booked TS for today wrt to panel no.
        $ts_booked_student = TimeslotBooking::where('panel', $panel_no)
                            ->where('date',$todayDate)
                            ->where('userid', '!=', null)
                            ->get();
        $userid_panel= TimeslotBooking::where('panel', $panel_no)
                            ->where('date',$todayDate)
                            ->where('userid', '!=', null)->orderBy('userid')
                            ->select('userid')->get();

        $user_data = OnlineProfile::select('online_profile_response.id','online_profile_response.userid','name','email','phone', 'eyrc_theme','college','branch','year','st.userid', 'st.availableslots')
                            ->join('timeslot_booking as st','st.userid','=','online_profile_response.userid')
                            ->where('date',$todayDate)
                            ->where('st.userid', '!=', null)
                            ->where('st.panel', $panel_no)
                            ->orderBy('st.userid')
                            ->distinct('online_profile_response.id')
                            ->get();
        log::info($ts_booked_student); 
        log::info($userid_panel); 
        log::info('----------------------'); 
        log::info($user_data); 
               
        return view('InterviewResult')->with('ts_booked_student', $ts_booked_student)
                                        ->with('panel_no', $panel_no)
                                        ->with('userid_panel', $userid_panel)
                                        ->with('user_data', $user_data);
    }
   
}
