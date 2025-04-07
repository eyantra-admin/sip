<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
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
use App\Model\StudentProjDtls;

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
                            ->where('users.year', 2025)
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
            $students = User::select('users.id','profile.name','profile.phone','profile.year','branch','college','exam_start','exam_end','nu_leaves','outside_prj_willingness','preferred_internship_time')
                    ->join('online_profile_response as profile','profile.userid','=','users.id')
                    ->where('users.id', $userId)->first();

            $student_projects = StudentProjDtls::select('student_project_dtls.*','s1.skill as skills1','s2.skill as skills2','s3.skill as skills3')
                ->join('skills_list as s1','student_project_dtls.skills1','=','s1.id')
                ->join('skills_list as s2','student_project_dtls.skills2','=','s2.id')
                ->join('skills_list as s3','student_project_dtls.skills3','=','s3.id')
                ->where('userid', $userId)
                ->get();        

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
                        'p3.id as p3_id','p3.projectname as p3_name','decision','technicalstrength','outside_prj_willingness','exam_schedule_clash','student_evaluation.remark'
                    )->join('projects as p1','p1.id', '=', 'student_evaluation.projectpref1')
                    ->join('projects as p2','p2.id', '=', 'student_evaluation.projectpref2')
                    ->join('projects as p3','p3.id', '=', 'student_evaluation.projectpref3')
                    ->where('student_evaluation.userid', '=', $userId)
                    ->first();
            } else {
                $panel_eval = null;
            }
        } else {
            $students = User::select('id','name')->where('role', 1)->where('year', 2025)
            ->where('active', 1)->orderby('name')->get();

            $preferences = null;
        }        
        $projects = Projects::select('id','projectname')->where(['active' => 1, 'year' => 2025])->orderBy('projectname')->get();
        
        return view ('Evaluation')->with('projects', $projects)->with('students', $students)->with('student_projects', $student_projects)->with('preferences', $preferences)->with('panel_eval', $panel_eval);
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
            $mentorPanel = UserPanel::where('userid', Auth::user()->id)->value('panelid');
            $studentPanel = UserPanel::where('userid', $request->studentname)->value('panelid');

            if($mentorPanel != $studentPanel){
                return back()->withErrors(__('This is not assigned to your Panel. Not allowed.'));
            }
            
            //log::info($request->all());
            $stud = StudentEvaluation::updateOrCreate([
                'userid' =>  $request->studentname
            ],[
                'projectpref1' => $request->projectpref1, 
                'projectpref2' => $request->projectpref2, 
                'projectpref3' => $request->projectpref3,  
                'decision' => $request->decision,
                'technicalstrength' => $request->technicalstrength,
                'outside_prj_willingness' => $request->outside_prj_willingness,
                'exam_schedule_clash' => $request->exam_schedule_clash,
                'remark' => $request->remark
            ]);

            return back()->withStatus(__('Student evaluation done successfully.'));

        }        
   }

    public function EvaluationResultAdmin($userId){   
        if($userId){
            $student = User::select('users.id','name', 'panelid')
                    ->leftjoin('user_panel as panel', 'users.id', '=', 'panel.userid') 
                    ->where('users.id', $userId)
                    ->first();

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
                        'p3.id as p3_id','p3.projectname as p3_name','decision','technicalstrength','outside_prj_willingness','exam_schedule_clash','student_evaluation.remark'
                    )->join('projects as p1','p1.id', '=', 'student_evaluation.projectpref1')
                    ->join('projects as p2','p2.id', '=', 'student_evaluation.projectpref2')
                    ->join('projects as p3','p3.id', '=', 'student_evaluation.projectpref3')
                    ->where('student_evaluation.userid', '=', $userId)
                    ->first();
            } else {
                $panel_eval = null;
            }

            return view ('EvaluationAdmin')->with('student', $student)->with('preferences', $preferences)->with('panel_eval', $panel_eval);
        }         
        
    }

    public function ExportEvaluationResult(Request $request){
            $data = User::select('users.name','users.email','tb.date as interview_date','availableslots as interview_time','panel','decision','technicalstrength','outside_prj_willingness','exam_schedule_clash','se.remark as remark')
                    ->selectRaw('(select projects.projectname from projects where sp.projectprefer1 = projects.id) as student_preference1')
                    ->selectRaw('(select projects.projectname from projects where sp.projectprefer2 = projects.id) as student_preference2')
                    ->selectRaw('(select projects.projectname from projects where sp.projectprefer3 = projects.id) as student_preference3')
                    ->selectRaw('(select projects.projectname from projects where sp.projectprefer4 = projects.id) as student_preference4')
                    ->selectRaw('(select projects.projectname from projects where sp.projectprefer5 = projects.id) as student_preference5')
                    ->selectRaw('(select projects.projectname from projects where se.projectpref1 = projects.id) as mentor_preference1')
                    ->selectRaw('(select projects.projectname from projects where se.projectpref2 = projects.id) as mentor_preference2')
                    ->selectRaw('(select projects.projectname from projects where se.projectpref3 = projects.id) as mentor_preference3')
                    ->leftjoin('studentprojprefer as sp', 'sp.userid', '=', 'users.id')
                    ->leftjoin('student_evaluation as se', 'se.userid', '=', 'users.id')
                    ->leftjoin('timeslot_booking as tb', 'tb.userid', '=', 'users.id')
                    ->where(['role' => 1, 'users.year' => 2025])
                    ->orderBy('tb.panel')
                    ->orderBy('tb.date')
                    ->orderByRaw("STR_TO_DATE(availableslots, '%l:%i %p')")
                    ->get();

            /*$csvFileName = 'evaluation.csv';
            $headers = [
                'Content-Type' => 'text/csv',
                //'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
            ];

            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'name', 
                'email',
                'student_preference1',
                'student_preference2',
                'student_preference3',
                'student_preference4',
                'student_preference5',
                'interview_date',
                'interview_time',
                'panel',
                'decision',
                'technicalstrength',
                'outside_prj_willingness',
                'exam_schedule_clash',
                'remark',
                'mentor_preference1',
                'mentor_preference2',
                'mentor_preference3'

            ]); // Add more headers as needed

            foreach ($data as $evaluation) {
                fputcsv($handle, [
                    $evaluation->name, 
                    $evaluation->email,
                    $evaluation->student_preference1,
                    $evaluation->student_preference2,
                    $evaluation->student_preference3,
                    $evaluation->student_preference4,
                    $evaluation->student_preference5,
                    $evaluation->interview_date,
                    $evaluation->interview_time,
                    $evaluation->panel,
                    $evaluation->decision,
                    $evaluation->technicalstrength,
                    $evaluation->outside_prj_willingness,
                    $evaluation->exam_schedule_clash,
                    $evaluation->remark,
                    $evaluation->mentor_preference1,
                    $evaluation->mentor_preference2,
                    $evaluation->mentor_preference3
                ]); // Add more fields as needed
            }

            fclose($handle);

            return Response::make('', 200, $headers);*/

            $fileName = 'evaluation.csv';
            
            $headers = array(
                "Content-type"        => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma"              => "no-cache",
                "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
                "Expires"             => "0"
            );

            $columns = array(
                'name', 
                'email',
                'student_preference1',
                'student_preference2',
                'student_preference3',
                'student_preference4',
                'student_preference5',
                'interview_date',
                'interview_time',
                'panel',
                'decision',
                'technicalstrength',
                'outside_prj_willingness',
                'exam_schedule_clash',
                'remark',
                'mentor_preference1',
                'mentor_preference2',
                'mentor_preference3'
            );

            $callback = function() use($data, $columns) {
                $file = fopen('php://output', 'w');
                fputcsv($file, $columns);

                foreach ($data as $evaluation) {
                    $row['name']  = $evaluation->name;
                    $row['email']    = $evaluation->email;
                    $row['student_preference1']  = $evaluation->student_preference1;
                    $row['student_preference2']  = $evaluation->student_preference2;
                    $row['student_preference3']  = $evaluation->student_preference3;
                    $row['student_preference4']  = $evaluation->student_preference4;
                    $row['student_preference5']  = $evaluation->student_preference5;
                    $row['interview_date']  = $evaluation->interview_date;
                    $row['interview_time']  = $evaluation->interview_time;
                    $row['panel']  = $evaluation->panel;
                    $row['decision']  = $evaluation->decision;
                    $row['technicalstrength']  = $evaluation->technicalstrength;
                    $row['outside_prj_willingness']  = $evaluation->outside_prj_willingness;
                    $row['exam_schedule_clash']  = $evaluation->exam_schedule_clash;
                    $row['remark']  = $evaluation->remark;
                    $row['mentor_preference1']  = $evaluation->mentor_preference1;
                    $row['mentor_preference2']  = $evaluation->mentor_preference2;
                    $row['mentor_preference3']  = $evaluation->mentor_preference3;

                    fputcsv($file, array($row['name'], $row['email'], $row['student_preference1'], $row['student_preference2'], $row['student_preference3'], $row['student_preference4'], $row['student_preference5'], $row['interview_date'], $row['interview_time'], $row['panel'], $row['decision'], $row['technicalstrength'], $row['outside_prj_willingness'], $row['exam_schedule_clash'], $row['remark'], $row['mentor_preference1'], 
                        $row['mentor_preference2'], $row['mentor_preference3']));                   
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
            
        }
   
}