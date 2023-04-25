<?php

namespace App\Http\Controllers;
use App\Model\OnlineProfile;
use App\Model\CollegeDetails;
use App\Model\ElsiState;
use App\Model\Projects;
use App\Model\StudentProjPrefer;
use App\Model\StudentEvaluation;
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
        $start_date = date('2022-05-01 00:00:00');
        //get auth(logged in user) panel id
        $panel_no = UserPanel::where('userid', Auth::user()->id)->value('panelid');
        //get all student user id's who booked TS  wrt to panel no.
        $ts_booked_student = TimeslotBooking::select('timeslot_booking.userid', 'timeslot_booking.date', 
                                                'timeslot_booking.availableslots', 'timeslot_booking.panel')
                            ->join('users','users.id','=','timeslot_booking.userid')
                            ->where('users.active', 1)
                            // ->where('date',$todayDate)
                            ->where('userid', '!=', null)
                            ->where('panel', $panel_no)
                            ->get();
        
        $user_data = OnlineProfile::select('online_profile_response.id','online_profile_response.userid','online_profile_response.name','online_profile_response.email','online_profile_response.phone', 'eyrc_theme','college','branch','online_profile_response.year','st.userid', 'st.availableslots', 'st.date')
                            ->join('timeslot_booking as st','st.userid','=','online_profile_response.userid')
                            ->join('users','users.id','=','st.userid')
                            // ->where('date',$todayDate)
                            ->where('st.userid', '!=', null)
                            ->where('st.panel', $panel_no)
                            ->where('users.active', 1)
                            ->where('users.year', 2023)
                            ->orderBy('st.date','asc')
                            ->orderBy('st.availableslots','asc')
                            ->distinct('online_profile_response.id')
                            ->get();
               
        return view('InterviewResult')->with('ts_booked_student', $ts_booked_student)
                                        ->with('panel_no', $panel_no)
                                        ->with('user_data', $user_data);
    }

    public function EvaluationResult()
    {   //$start_date = date('2022-05-01 00:00:00');
        $students = User::select('id','name')->where('role', 1)->where('year', 2023)->where('active', 1)->orderby('name')->get();
        $projects = Projects::select('id','projectname')->where(['active' => 1, 'year' => 2023])->orderBy('projectname')->get();
        
        return view ('Evaluation')->with('projects', $projects)->with('students', $students);
    }
    public function EvaluationSubmit(Request $request)
    {
        log::info($request->all());
       $stud = StudentEvaluation::updateOrCreate(
            ['userid' =>  $request->studentname],
            ['projectpref1' => $request->projectpref1, 
            'projectpref2' => $request->projectpref2, 
            'projectpref3' => $request->projectpref3,  
            'decision' => $request->decision,
            'technicalstrength' => $request->technicalstrength,
            'remark' => $request->remark]
        );
       return back()->withStatus(__('Student evaluation done successfully.'));
   }
   
}