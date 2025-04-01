<?php

namespace App\Http\Controllers;
use App\Model\OnlineProfile;
use App\Model\CollegeDetails;
use App\Model\ElsiState;
use App\Model\Projects;
use App\Model\StudentProjPrefer;
use App\Model\StudentEvaluation;
use App\Model\InternEvaluation;
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


class final_evalController extends Controller
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
    public function FinalEvaluationResult()
    {   $start_date = date('2022-05-01 00:00:00');
        $interns = User::select('id','name')->where('role', 1)->where('year', 2025)->where('active', 1)->where('selected',1)->orderby('name')->get();
        $projects = Projects::select('id','projectname')->where(['active' => 1, 'year' => 2025])->orderBy('projectname')->get();
        return view ('final_eval')->with('projects', $projects)->with('interns', $interns);
    }

    public function getInternProject(Request $request){
        $internId = $request->internId;

        $intern = User::where('id', $internId)->first(['project_alloted']);

        if($intern){        
            $projects = Projects::where('id', $intern->project_alloted)->first(['id','projectname']);
        }   
    
        return json_encode($projects);
    }

    public function FinalEvaluationSubmit(Request $request)
    {
       $check_internid = $request->internname;

       $inter = InternEvaluation::where('intern_eval.userid','=',$check_internid)
                ->first();

        if(!empty($inter)){
        $inter->projectid = $request->projectpref1;
        $inter->tech_skill = $request->tech_skill;
        $inter->quality = $request->quality;
        $inter->attitude = $request->attitude;
        $inter->punctuality = $request->punctuality;
        $inter->team_work = $request->team_work;
        $inter->documentation = $request->documentation;
        $inter->presentation = $request->presentation;
        $inter->content = $request->content;
        $inter->save();
        }
        else {
        $inter = New InternEvaluation();
        $inter->userid = $check_internid;
        $inter->projectid = $request->projectpref1;
        $inter->tech_skill = $request->tech_skill;
        $inter->quality = $request->quality;
        $inter->attitude = $request->attitude;
        $inter->punctuality = $request->punctuality;
        $inter->team_work = $request->team_work;
        $inter->documentation = $request->documentation;
        $inter->presentation = $request->presentation;
        $inter->content = $request->content;
        $inter->save();
        }

       return back()->withStatus(__('Student evaluation done successfully.'));
   }
   
}