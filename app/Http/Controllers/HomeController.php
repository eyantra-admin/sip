<?php

namespace App\Http\Controllers;
use App\Model\OnlineProfile;
use App\Model\CollegeDetails;
use App\Model\ElsiState;
use App\Model\Projects;
use App\Model\StudentProjPrefer;
use App\User;
use App\Model\TimeslotBooking;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Input;
use Log;
use DB;
use Auth;
use Validator;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $chksubmitted = User::where('email',Auth::user()->email)->first();
        return view('dashboard')
        ->with('form_submitted', $chksubmitted->profilesubmitted);

        //return view('dashboard');
    }
    public function dashboard()
    {
        $chksubmitted = User::where('email',Auth::user()->email)->first();
        return view('dashboard')
        ->with('form_submitted', $chksubmitted->profilesubmitted);
        //return view('dashboard');
    }
    


    public static function getCountrywiseStates(Request $request)
    {
        $country = $request->country;
        log::info('-----------');
        log::info($country);
        $state=ElsiState::where('country',$country)->pluck('state');    
    
        return json_encode($state);
    }

    public static function getstatewiseColleges(Request $request)
    {
        $state = $request->state;
        $clgs = CollegeDetails::where('state', $state)->select(['id', DB::raw("CONCAT_WS(',',college_list.college_name,college_list.district)  AS college_name"),'address'])->orderBy('college_name', 'ASC')->get();
    
        return json_encode($clgs);
    }

    public static function getcollegeinfo(Request $request)
    {
        $clg_id = $request->college_id;
        $clgs = CollegeDetails::where('id', $clg_id)->get();
        return json_encode($clgs);
    }




    public static function projectpreference(Request $request)
    {
        $projects = Projects::select('id','projectname')->orderBy('projectname')->get();
        return view ('project.preference')
        ->with('projects', $projects);
    }

    public static function preferenceupdate(Request $request)
    {
        $input = $request->all();
        $rules=[
        'project_preference_1'  => 'required|not_in:0',
        'project_preference_2'  => 'required|not_in:0',
        'project_preference_3'  => 'required|not_in:0',
        ];
        $messages = [   'project_preference_1.required' => 'Select first project preference',
                        'project_preference_2.required' => 'Select second project preference',
                        'project_preference_3.required' => 'Select third project preference',
                    ];
        $validate=Validator::make($request->all(),$rules,$messages);

        if($validate->fails())
        {
            return redirect()->route('project.preferenceupdate')->withErrors($validate)->withInput($input);
        }
        else
        {
            //Check if profile is submitted, if yes then only proceed with adding preferences
            if(Auth::user()->profilesubmitted == 0)
            {
                return back()->withErrors(__('You have not submitted your profile. submit the form & then proceed with adding preferences.'));
            }
            else
            {
                if($request->project_preference_1 && $request->project_preference_2 && $request->project_preference_3 !=0)
                {
                    $prefer1= $request->project_preference_1;
                    $prefer2= $request->project_preference_2;
                    $prefer3= $request->project_preference_3;
                    $userid= Auth::user()->id;
                    //Check if all 3 dropdowns have different selections
                    if($prefer2 == $prefer1 || $prefer2 == $prefer3)
                    {
                        return back()->withErrors(__('All project preferences must be unique.'));
                    }
                    elseif ($prefer3 == $prefer1 || $prefer3 == $prefer2) {
                        return back()->withErrors(__('All project preferences must be unique.'));
                    }
                    else
                    {
                        // $post = StudentProjPrefer::create( $request->all() );
                        $user = StudentProjPrefer::where('userid', '=', $userid)->first();
                        if ($user === null) 
                        {
                           // user doesn't exist
                            $studproj = StudentProjPrefer::create([
                            'userid' => $userid,
                            'projectprefer1' => $prefer1,
                            'projectprefer2' => $prefer2,
                            'projectprefer3' => $prefer3,
                            ]);
                            return back()->withStatus(__('Project preferences added successfully.'));
                        }
                        else
                        {
                             return back()->withErrors(__('Project preferences for this user already exists.'));
                        }
                    }           
                }
                else
                {
                    return back()->withErrors($errors, 'Select all three project preferences');
                }
            }   
        }
    }

    public static function getprojectdetail($projectid)
    {
        log::info($projectid);
        $getproject_dtl = Projects::where('id', $projectid)->first();
        log::info($getproject_dtl);
        return view('project.projectdetail')
        ->with('projectdtl', $getproject_dtl);

    }
    

    //TimeSlot Booking
    public static function timeslotbooking(Request $request)
    {
        $dates = TimeslotBooking::select('date')->distinct()->orderBy('date')->get();
        $availableslot = TimeslotBooking::select('availableslots')
                        ->where('availableflag',1)
                        ->get();
        return view ('timeslotbooking')
        ->with('dates', $dates)
        ->with('availableslot', $availableslot);
    }

    public static function gettimeslot(Request $request)
    {
        log::info($request->date);
        $dates = TimeslotBooking::select('date')->distinct()->orderBy('date')->get();
        $availableslot = TimeslotBooking::select('availableslots')
                        ->where('date',$request->date)
                        ->where('availableflag',1)
                        ->get();
        log::info('------------');
        log::info($availableslot);
        // return view ('timeslotbooking')
        // ->with('dates', $dates)
        // ->with('availableslot', $availableslot);
        return json_encode($availableslot);
    }

    public static function booktimeslot(Request $request)
    {
        log::info('into time slot booking');
        $studentid = OnlineProfile::where('userid', Auth::user()->id)->pluck('id');

        //update student id in table where date and slot is matched
        $booking = DB::table('timeslot_booking')
              ->where('date', $request->date)
              ->where('availableslots', $request->timeslot)
              ->update(['studentid' => $studentid]);
    }
    

}
