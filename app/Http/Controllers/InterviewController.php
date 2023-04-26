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
use Redirect;


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

    public function EvaluationResult($userId)
    {   //$start_date = date('2022-05-01 00:00:00');
        if($userId){
            $students = User::select('id','name')->where('id', $userId)->get();

            //student project preferences
            if(StudentProjPrefer::where('userid', $userId)->exists()) {                
                $preferences = StudentProjPrefer::select(
                        'p1.id as p1_id','p1.projectname as p1_name',
                        'p2.id as p2_id','p2.projectname as p2_name',
                        'p3.id as p3_id','p3.projectname as p3_name',
                        'p4.id as p4_id','p4.projectname as p4_name',
                        'p5.id as p5_id','p5.projectname as p5_name'
                    )->join('projects as p1','p1.id', '=', 'studentprojprefer.projectprefer1')
                    ->join('projects as p2','p2.id', '=', 'studentprojprefer.projectprefer2')
                    ->join('projects as p3','p3.id', '=', 'studentprojprefer.projectprefer3')
                    ->join('projects as p4','p4.id', '=', 'studentprojprefer.projectprefer4')
                    ->join('projects as p5','p5.id', '=', 'studentprojprefer.projectprefer5')
                    ->where('studentprojprefer.userid', '=', $userId)
                    ->first();
                // exists
            } else {
                $preferences = null;
            }   

            //evaluation by panel
            if(StudentEvaluation::where('userid', $userId)->exists()){
                $panel_eval = StudentEvaluation::select(
                        'p1.id as p1_id','p1.projectname as p1_name',
                        'p2.id as p2_id','p2.projectname as p2_name',
                        'p3.id as p3_id','p3.projectname as p3_name','decision','technicalstrength','remark'
                    )->join('projects as p1','p1.id', '=', 'student_evaluation.projectpref1')
                    ->join('projects as p2','p2.id', '=', 'student_evaluation.projectpref2')
                    ->join('projects as p3','p3.id', '=', 'student_evaluation.projectpref3')
                    ->where('student_evaluation.userid', '=', $userId)
                    ->first();
            } else {
                $panel_eval = null;
            }
        } else {
            $students = User::select('id','name')->where('role', 1)->where('year', 2023)
            ->where('active', 1)->orderby('name')->get();

            $preferences = null;
        }        
        $projects = Projects::select('id','projectname')->where(['active' => 1, 'year' => 2023])->orderBy('projectname')->get();
        
        return view ('Evaluation')->with('projects', $projects)->with('students', $students)->with('preferences', $preferences)->with('panel_eval', $panel_eval);
    }
    public function EvaluationSubmit(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'studentname' => 'required',
            'projectpref1' => 'required',
            'projectpref2' => 'required',
            'projectpref3' => 'required',                 
        ],[
            'studentname.required' => 'Please Select Student name',
            'projectpref1.required' =>  'Please select Project 1',
            'projectpref2.required' =>  'Please select Project 2',
            'projectpref3.required' =>  'Please select Project 3',
        ]);

        if($validator->fails())
        {
            return Redirect::back()->withErrors($validator);
        } else {

            //log::info($request->all());
            $stud = StudentEvaluation::updateOrCreate([
                'userid' =>  $request->studentname
            ],[
                'projectpref1' => $request->projectpref1, 
                'projectpref2' => $request->projectpref2, 
                'projectpref3' => $request->projectpref3,  
                'decision' => $request->decision,
                'technicalstrength' => $request->technicalstrength,
                'remark' => $request->remark
            ]);

            return back()->withStatus(__('Student evaluation done successfully.'));

        }        
   }
   
}