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


class Progress_Eval extends Controller
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
    public function ProgressEvaluationResult()
    {   $start_date = date('2022-05-01 00:00:00');
        $interns = User::select('id','name')->where('role', 1)->where('year', 2023)->where('active', 1)->where('selected',1)
        ->orderby('name')->get();
        $projects = Projects::select('id','projectname')->where(['active' => 1, 'year' => 2023])->orderBy('projectname')->get();
        return view ('Progress_Eval')->with('projects', $projects)->with('interns', $interns);
    }
    public function ProgressEvaluationSubmit(Request $request)
    {
       $inter = InternEvaluation::updateOrCreate(
            ['userid' =>  $request->internname],
            ['projectid' => $request->projectpref1,  
            'skill_match' => $request->skillset,
            'strength' => $request->technicalstrength,
            'efforts' => $request->efforts,
            'output' => $request->output,
            'academic_load' => $request->academic,
            'extention' => $request->extention,
            'communication' => $request->communication,
            'remarks' => $request->remark]
        );
        log::info($request->all());

       return back()->withStatus(__('Student evaluation done successfully.'));
   }
   
}