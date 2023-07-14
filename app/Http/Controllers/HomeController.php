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
use App\Model\skills_list;
use App\Model\InternEvaluation;
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

    public function index(){
        //log::info('Inside Home');
        //log::info(Auth::user());
        if(Auth::user()->role == 3)
            return redirect()->route('View_profiles');

        if(Auth::user() == null)
            return redirect()->route('keycloak.login');
        else
        {
            if(Auth::user()->active == 0){
                return redirect()->route('error')->withErrors(__('Your account is deactive.'));
            }else{
                $chksubmitted = User::where('email',Auth::user()->email)->first();
                $proj_alloted_id = User::where('id',Auth::user()->id)->pluck('project_alloted');
                $proj_alloted = Projects::where('id', $proj_alloted_id)->get();
                $cert_check = OnlineProfile::where('userid', Auth::user()->id)->value('cert_level');
                Log::info($cert_check);
                return view('dashboard')
                ->with(['form_submitted' => $chksubmitted->profilesubmitted, 'cert_check' => $cert_check, 'project_alloted' => $proj_alloted]);
                    // return view('dashboard');, 
            }    
        }
    }
    
    public function error()
    {
        return view('error');
    }

    public function dashboard()
    {
        $id = encrypt(Auth::user()->id);
        $chksubmitted = User::where('email',Auth::user()->email)->first();
        $proj_alloted_id = User::where('id',Auth::user()->id)->pluck('project_alloted');
        $proj_alloted = Projects::where('id', $proj_alloted_id)->first();
        //log::info($proj_alloted);
        return view('dashboard')
        ->with('form_submitted', $chksubmitted->profilesubmitted)  
        ->with('project_alloted', $proj_alloted)
        ->with('id', $id);
        //return view('dashboard');
    
    }
    
    public static function getCountrywiseStates(Request $request)
    {
        $country = $request->country;
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
        $projects = Projects::select('id','projectname')->where(['active' => 1, 'year' => 2023])->orderBy('projectname')->get();
        $proj_prefer = StudentProjPrefer ::where('userid', Auth::user()->id)->count();
        if($proj_prefer == 0)
        {
            return view ('project.preference')
            ->with('proj_prefer',$proj_prefer)
            ->with('projects', $projects);
        }
        else
        {
            $selected_projects = StudentProjPrefer ::where('userid', Auth::user()->id)->first();
            //log::info($selected_projects);
            $project1 = Projects::where('id' ,$selected_projects->projectprefer1)->value('projectname');
            $project2 = Projects::where('id' ,$selected_projects->projectprefer2)->value('projectname');
            $project3= Projects::where('id' ,$selected_projects->projectprefer3)->value('projectname');
            $project4 = Projects::where('id' ,$selected_projects->projectprefer4)->value('projectname');
            $project5 = Projects::where('id' ,$selected_projects->projectprefer5)->value('projectname');
            return view ('project.preference')
            ->with('project1', $project1)
            ->with('project2', $project2)
            ->with('project3', $project3)
            ->with('project4', $project4)
            ->with('project5', $project5)
            ->with('proj_prefer',$proj_prefer)
            ->with('projects', $projects);
        }
    }

    public static function preferenceupdate(Request $request)
    {
        $input = $request->all();
        $rules=[
        'project_preference_1'  => 'required|not_in:0',
        'project_preference_2'  => 'required|not_in:0',
        'project_preference_3'  => 'required|not_in:0',
        'project_preference_4'  => 'required|not_in:0',
        'project_preference_5'  => 'required|not_in:0',
        ];
        $messages = [   'project_preference_1.required' => 'Select first project preference',
                        'project_preference_2.required' => 'Select second project preference',
                        'project_preference_3.required' => 'Select third project preference',
                        'project_preference_4.required' => 'Select fourth project preference',
                        'project_preference_5.required' => 'Select fifth project preference',
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
                return back()->withErrors(__('You have not submitted your profile.'));
            }
            else
            {
                if($request->project_preference_1 && $request->project_preference_2 && 
                   $request->project_preference_3 && $request->project_preference_4 &&
                   $request->project_preference_5 !=0)
                {
                    $prefer1= $request->project_preference_1;
                    $prefer2= $request->project_preference_2;
                    $prefer3= $request->project_preference_3;
                    $prefer4= $request->project_preference_4;
                    $prefer5= $request->project_preference_5;
                    $userid= Auth::user()->id;
                    //Check if all 5 dropdowns have different selections
                    $chkarr  = array($prefer1,$prefer2,$prefer3,$prefer4,$prefer5);
                    log::info($chkarr);
                    $unique_values = count(array_count_values($chkarr));
                    log::info($unique_values);
                    if($unique_values == 5)
                    {
                        $user = StudentProjPrefer::where('userid', '=', $userid)->first();
                        if ($user === null) 
                        {
                           // user doesn't exist
                            $studproj = StudentProjPrefer::create([
                            'userid' => $userid,
                            'projectprefer1' => $prefer1,
                            'projectprefer2' => $prefer2,
                            'projectprefer3' => $prefer3,
                            'projectprefer4' => $prefer4,
                            'projectprefer5' => $prefer5,
                            ]);
                            return back()->withStatus(__('Project preferences added successfully.'));
                        }
                        else
                        {
                             return back()->withErrors(__('Project preferences for this user already exists.'));
                        }
                    }
                    else
                    {
                        return back()->withErrors(__('All project preferences must be unique.'));
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
        //log::info($projectid);
        $getproject_dtl = Projects::where('id',Crypt::decrypt($projectid))->first();
        
        if(Auth::user()->role == 2 || Auth::user()->role == 3){
            $p1_student_list = DB::table('users')
                ->join('student_evaluation', 'users.id', '=', 'student_evaluation.userid')
                ->where('projectpref1', Crypt::decrypt($projectid))
                ->select('users.id','name','decision')
                ->get();

            $p2_student_list = DB::table('users')
                ->join('student_evaluation', 'users.id', '=', 'student_evaluation.userid')
                ->where('projectpref2', Crypt::decrypt($projectid))
                ->select('users.id','name','decision')
                ->get();

            $p3_student_list = DB::table('users')
                ->join('student_evaluation', 'users.id', '=', 'student_evaluation.userid')
                ->where('projectpref3', Crypt::decrypt($projectid))
                ->select('users.id','name','decision')
                ->get();        
        } else {
            $p1_student_list = null;
            $p2_student_list = null;
            $p3_student_list = null;
        }
        
        return view('project.projectdetail')
            ->with('projectdtl', $getproject_dtl)
            ->with(['p1_list' => $p1_student_list, 'p2_list' => $p2_student_list, 'p3_list' => $p3_student_list]);

    }

    //TimeSlot Booking
    public static function timeslotbooking(Request $request)
    {
        $panel = UserPanel::where('userid', Auth::user()->id)->value('panelid');//select allocated panel
        $dates = TimeslotBooking::select('date')->distinct()
                                ->where('panel', $panel)
                                ->where('availableflag',1)
                                ->orderBy('date')->get(); //get panel dates
        $already_booked = TimeslotBooking::where('userid', Auth::user()->id)->count();
        if($already_booked == 0)
            {
                return view ('timeslotbooking')
                ->with('dates', $dates)
                ->with('panel',$panel)
                ->with('UserBooked_slots', 0)
                ->with('already_booked', $already_booked);
            }
            else
            {
                $UserBooked_slots = TimeslotBooking::where('userid', Auth::user()->id)->first();
                log::info($UserBooked_slots);  
                return view ('timeslotbooking')
                ->with('dates', $dates)
                ->with('panel',$panel)
                ->with('UserBooked_slots', $UserBooked_slots)
                ->with('already_booked', $already_booked);
            }

           
    }

    public static function gettimeslot(Request $request)
    {
        //log::info($request->date);
        //log::info('------------PANEL-----------------');
        //log::info($request->panel);
        $dates = TimeslotBooking::select('date')->distinct()
                                ->orderBy('date')->get();
        $availableslot = TimeslotBooking::
                        where('date',$request->date)
                        ->where('availableflag',1)
                        ->where('panel', $request->panel) 
                        ->pluck('availableslots');
        //log::info('------------');
        log::info($availableslot);
        return json_encode($availableslot);
    }

    public static function booktimeslot(Request $request)
    {
        //log::info('into time slot booking');
        $rules=[
        'date' => 'required',
        'timeslot' => 'required',];

        $messages = [   'date.required' => 'Please select date',
                        'timeslot.required' =>  'Please select timeslot',
                    ];
        $validate=Validator::make($request->all(),$rules,$messages);

        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate);
        }
        else
        {   
             //Check if profile is submitted, if yes then only proceed with adding preferences
            if(Auth::user()->profilesubmitted == 0)
            {
                return back()->withErrors(__('You have not submitted your profile. Time slot booking is not allowed'));
            }
            else
            {
                //log::info($request->date);
                //log::info($request->timeslot);
                $panel = UserPanel::where('userid', Auth::user()->id)->value('panelid');//select allocated panel
                //log::info($panel);
                //update student id and flag in table where date ,slot and panel is matched
                $already_booked = TimeslotBooking ::where('userid', Auth::user()->id)->count();
                if($already_booked == 0)
                {
                    $booking = DB::table('timeslot_booking')
                      ->where('date', $request->date)
                      ->where('availableslots', $request->timeslot)
                      ->where('panel', $panel)
                      ->update(['userid' => Auth::user()->id, 'availableflag' => 0]);
                    return back()->withStatus(__('Timeslot booked successfully.'));
                }
                else
                {
                    return back()->withErrors(__('You have already booked the timeslot.'));
                }
            }
        }
    }

    public static function Upload(Request $request)
    {
       return view('upload'); 
    }

    public static function viewpreferences(Request $request)
    {
        $panel = UserPanel::where('userid', Auth::user()->id)->value('panelid');//select allocated panel

        $result = StudentProjPrefer::select('studentprojprefer.userid','u.name',
         'studentprojprefer.projectprefer1','p1.projectname as P1name',
         'studentprojprefer.projectprefer2','p2.projectname as P2name', 
         'studentprojprefer.projectprefer3','p3.projectname as P3name',
         'studentprojprefer.projectprefer4','p4.projectname as P4name',
         'studentprojprefer.projectprefer5','p5.projectname as P5name')
        //->join('online_profile_response as o', 'o.userid', '=', 'studentprojprefer.userid')
        ->rightjoin('users as u', 'u.id', '=', 'studentprojprefer.userid')
        ->leftjoin('projects as p1','p1.id', '=', 'studentprojprefer.projectprefer1')
        ->leftjoin('projects as p2','p2.id', '=', 'studentprojprefer.projectprefer2')
        ->leftjoin('projects as p3','p3.id', '=', 'studentprojprefer.projectprefer3')
        ->leftjoin('projects as p4','p4.id', '=', 'studentprojprefer.projectprefer4')
        ->leftjoin('projects as p5','p5.id', '=', 'studentprojprefer.projectprefer5')
        ->leftjoin('user_panel as panel', 'u.id', '=', 'panel.userid')        
        ->where('u.active', 1)
        ->where('u.role', 1)
        ->where('u.year', 2023)
        ->where('panel.panelid', $panel)
        ->orderBy('u.name','asc')
        ->get();
        //log::info($result);
        return view('View_preferences')->with('preference', $result);
    }

    public static function viewtimeslot(Request $request, $panelId = null)
    {
        if($panelId != null && $panelId < 6){
            $panel_no = $panelId;
        } else {
            $panel_no = UserPanel::where('userid', Auth::user()->id)->value('panelid');
        }

        $result = TimeslotBooking::select('timeslot_booking.panel','timeslot_booking.userid',
            'u.name','u.email', 'timeslot_booking.date','timeslot_booking.availableslots','eval.decision','profile.branch')
        ->join('users as u', 'u.id', '=', 'timeslot_booking.userid')
        ->leftjoin('student_evaluation as eval', 'eval.userid', '=', 'u.id')
        ->join('online_profile_response as profile', 'u.id', '=', 'profile.userid')
        ->where('u.active', 1)
        ->where('u.year', 2023)
        ->where('panel', $panel_no)
        ->orderBy('timeslot_booking.date', 'asc')
        ->orderBy('timeslot_booking.id', 'asc')
        ->get();
        return view('View_timeslot')->with('timeslot', $result);
    }

    public static function internevaltable(Request $request)
    {
        $result = InternEvaluation::select('intern_eval.tech_skill','intern_eval.quality','intern_eval.attitude', 'intern_eval.punctuality','intern_eval.team_work','intern_eval.documentation','intern_eval.presentation','intern_eval.content',
            'u.name','u.email', 'p.projectname')
        ->join('users as u', 'u.id', '=', 'intern_eval.userid')
        ->leftjoin('projects as p', 'p.id', '=', 'intern_eval.projectid')
        ->where('u.year', 2023)
        ->whereNotNull('intern_eval.tech_skill')
        ->get();
        return view('InternEvalFinal')->with('timeslot', $result);
    }

    //Pre Internship Survey
    public static function preintershipsurvey(Request $request)
    {
        return view('PreInternship_survey');
    }

    
    public static function submitsurvey(Request $request)
    {
        //log::info($request->all());
        $already_submited = PreInternshipSurvey ::where('userid', Auth::user()->id)->count();
        if($already_submited == 0)
        {
            $survey = new PreInternshipSurvey;
            $survey->topics = implode(', ', $request->topics);
            $survey->specialists = implode(', ', $request->specialists);
            $survey->Internet = implode(', ', $request->Internet);
            $survey->serviceprovider = implode(', ', $request->Service);
            $survey->speed = $request->speed;
            $survey->rate = $request->rate;
            $survey->powercuts = $request->power;
            $survey->makemodel = $request->model;  
            $survey->ram = $request->ram;
            $survey->storage = $request->storage;
            $survey->processor = $request->processor;  
            $survey->processorgeneration = $request->processorgeneration;
            $survey->graphicscard = $request->graphics;
            $survey->os = $request->os;
            $survey->laptopbenchmark = $request->benchmark;
            $survey->userid = Auth::user()->id;
            if($request->txttopics != '' || !empty($request->othertopic))
            {
                $survey->othertopic = $request->othertopic;
            }
            if($request->txtspecialists != '' || !empty($request->otherspecialists))
            {
                $survey->otherspecialists = $request->otherspecialists;
            }
            if($request->txtservice != '' || !empty($request->otherservice))
            {
                $survey->otherservice = $request->otherservice;
            }
           
            $survey->save();

             $updatesurvey = DB::table('users')
                      ->where('id', Auth::user()->id)
                      ->update(['survey_done' => 1]);

            return redirect()->route('home')->withStatus(__('Internship Survey submitted successfully.'));
        }
        else
        {
            return back()->withErrors(__('You have already submitted the form.'));
        }

    }

    public static function faq()
    {
        return view('faq');
    }
    public static function nda()
    {
        //dd(storage_path());
        //return redirect()->route('home')->withStatus(__('Closed.'));
        return view('nda');
    }

    public function submitnda(Request $request)
    {
        //return redirect()->route('home')->withStatus(__('Closed.'));
        //log::info($request->all());
        $validator = Validator::make($request->all(), [
            'photo' => 'required|mimes:jpeg,jpg,png|required|max:10000',
            'signature' => 'required|mimes:jpeg,jpg,png|required|max:10000',
            'pancard' => 'required|mimes:jpeg,jpg,png|required|max:10000',
            'conduct' => 'required',                        
            ],
            [
            'photo' => 'Photograph is required!',
            'signatures' => 'Digital signature is required',
            'pancard' => 'Pan card is required',
            'conduct' => 'I agree not selected!',
            ]);

            if($validator->fails())
            {
                return back()->withErrors($validator);
            }
            else
            {   
                $feed = new EysipUploads;
                
                $feed->userid = Auth::user()->id;
                $feed->photo = $request->photo;
                $feed->signature = $request->signature;
                $feed->pancard = $request->pancard;
                $feed->conduct = $request->conduct;

                if($request->hasFile('photo') && $request->hasFile('pancard') 
                    && $request->hasFile('signature'))
                {
                    log::info('inside');
                    $format1 = strtolower($request->photo->getClientOriginalExtension());
                    $format2 = strtolower($request->pancard->getClientOriginalExtension());
                    $format3 = strtolower($request->signature->getClientOriginalExtension());
                    
                    $size1 = $request->file('photo')->getSize();
                    $size2 = $request->file('pancard')->getSize();
                    $size3 = $request->file('signature')->getSize();
                    //Log::info($size);
                if($size1 > 2097152 ||  $size2 > 2097152 || $size3 > 2097152)
                {
                    return back()->withErrors(__('Unable to upload the image. File size is more than 1 MB.'));
                }
                    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                    $random_str = substr(str_shuffle($permitted_chars), 0, 7);
                    
                    $userid = Auth::user()->id;

                    $file1 = $request->photo;
                    $newfilename1 = $userid.'_photo.'. $format1;
                    $path = Storage::disk('local')->putFileAs('sip_uploads',$file1,$newfilename1);

                    $file2 = $request->signature;
                    $newfilename2 = $userid.'_sign.'. $format2;
                    $path = Storage::disk('local')->putFileAs('sip_uploads',$file2,$newfilename2);

                    $file3 = $request->pancard;
                    $newfilename3 = $userid.'_pan.'. $format3;
                    $path = Storage::disk('local')->putFileAs('sip_uploads',$file3,$newfilename3);

                    $feed->photo = $userid. '_photo.' .$format1;
                    $feed->signature = $userid. '_sign.' .$format2;
                    $feed->pancard = $userid. '_pan.' .$format3;
                    $feed->save();

                    $updatenda = DB::table('users')
                      ->where('id', Auth::user()->id)
                      ->update(['nda_done' => 1]);
                    
                    return redirect()->route('home')->withStatus(__('NDA submitted successfully.'));
                }
                else
                {
                   return back()->withErrors(__('Something wrong'));
                }
            }
    }

    public function listAllnda() 
    {   $start_date = date('2022-05-01 00:00:00');
        $list_ndas = EysipUploads::select('u.id','name','email', 'project_alloted', 'p.projectname')->distinct()
        ->join('users as u','u.id','=','sipuploads.userid')
        ->join('projects as p', 'p.id', '=','u.project_alloted')
        ->where('u.year', 2023)
        ->get();
        Log::info($list_ndas);
        return view('listNDA',compact('list_ndas'));
    }

    public function downloadNDA($id)
    {
        //log::info('---------------------------');
        $nda_data=EysipUploads::where('userid', $id)->first();
        $user_data = User::find($id);
        //Log::info($nda_data);
        $pdf = \App::make('dompdf.wrapper');

        $pdf = PDF::loadView('nda_template', ['nda_data'=>$nda_data, 'user_data'=> $user_data]);
        return view('nda_template', compact('nda_data', 'user_data'));
    }
    

    public function verifydetails(Request $request)
    {
        //log::info(Auth::user()->id);
        $verify_data = User::select('users.id', 'users.name', 'users.email','users.Iconfirm', 'o.phone', 'project_alloted', 
                                        'p.projectname', 'o.year', 'o.branch', 'o.college',
                                        'o.addressline1','o.addressline2','o.city','o.statename', 'o.pincode',
                                        'o.bank_accountno','o.name_inbank','o.bank_name','o.ifsc',
                                        'o.bank_type','o.bank_address')
                                ->join('online_profile_response as o','o.userid', '=', 'users.id')
                                ->join('projects as p','p.id', '=', 'users.project_alloted')
                                ->where('users.id', Auth::user()->id)
                                ->where('payment_done', 1)
                                ->get();
             Log::info($verify_data);                   
        return view('verifydetails')
        ->with('verifydetails', $verify_data);
    }

    public function AcceptVerify(Request $request)
    {
        //log::info(Auth::user()->id);
         $booking = DB::table('users')
                      ->where('id', Auth::user()->id)
                      ->update(['Iconfirm' => 1]);
                    return back()->withStatus(__('Details verified successfully.'));     
        // return view('verifydetails')
        // ->with('verifydetails', $verify_data);
    }

    public function saveBankdetails(Request $request)
    {
        $validator = Validator::make($request->all() , [
            'vendorId' => 'required|alpha_num|min:5|max:10',
        ], [
            'vendorId' => 'VendorId is required',
        ]);
            
        if($validator->fails()) {
            return back()->withErrors($validator);
        } 

        $check_id = Auth::user()->id;
        $intern = OnlineProfile::where('online_profile_response.userid','=',$check_id)->first();
        $intern->bank_accountno = $request->vendorId;
        $intern->save();
        return redirect()->route('bank_details')->withStatus(__('Vendor ID saved successfully.'));
    }

    public function Bankdetails()
    {        
        $intern = OnlineProfile::where('online_profile_response.userid','=', Auth::user()->id)->first(['bank_accountno']);
        
        return view('bank_details')->with('intern', $intern);
    }


    public function mentorclearence(Request $request)
    {   $start_date = date('2022-05-01 00:00:00');
        $stud_list = User::select('users.id', 'users.name', 'users.email', 'project_alloted', 'p.projectname', 'users.Iconfirm',
            'users.MentorClearence')
                        ->join('online_profile_response as o','o.userid', '=', 'users.id')
                        ->join('projects as p','p.id', '=', 'users.project_alloted')
                        ->where('users.year', 2023)
                        ->where('users.selected', 1)
                        ->where('p.mentor1userid', '=', Auth::user()->id)
                        ->orwhere('p.mentor2userid', '=', Auth::user()->id)
                        ->orwhere('p.mentor3userid', '=', Auth::user()->id)
                        ->get();                   
        return view('mentorclearence')->with('stud_list', $stud_list);
    }
    public function approveclearence($userid)
    {
        //log::info($userid);
         $approve = DB::table('users')
                      ->where('id', $userid)
                      ->update(['MentorClearence' => 1]);
                    return back()->withStatus(__('Mentor Clearence done successfully.'));     
    }
     
    //Mentor=> Add Project
    public function addproject(Request $request)
    {
        //$project_cnt = projects::where('mentor1userid', Auth::user()->id)->count();
        $projects = Projects::select('id','projectname')->where(['active' => 1, 'year' => 2023])->orderBy('projectname')->get();
        $mentors = User::select('id','name as mentorname')->where('role', 2)->orderBy('name')->get();
        $skills = skills_list::orderBy('skill')->get();
        return view('project.addproject')->with('projects', $projects)
        ->with('mentors', $mentors)->with('skills', $skills);
    }

    //insert project
    public function insertproject(Request $request)
    {
        //log::info($request->all());
        $proj = new projects;
        $proj->projectname = $request->projectname;
        $proj->abstract = $request->projectabstract;
        //$proj->technologystack = $request->technologystack;
        $proj->interns_required = $request->interns;
        $proj->technologystack = implode(', ', $request->technologystack);
        $proj->active = 1;
        $proj->year = 2023;
        $proj->save();
        return back()->withStatus(__('Project added successfully.'));
    }

    //mentor allocation to project
    public static function savementorproject(Request $request)
    {
        $proj = new projects;
        $mentor_project = DB::table('projects')->where('id', $request->project)
                            ->update(['mentor1userid' => $request->mentor1,
                                      'mentor2userid' => $request->mentor2, 
                                      'mentor3userid' => $request->mentor3]);
        return back()->withStatus(__('Mentor Project allocation done successfully.'));

    }


    //View student profiles for mentor login
    public static function View_studentprofiles(Request $request)
    {   
        $result = OnlineProfile::select('online_profile_response.name','online_profile_response.email',
                'online_profile_response.phone','online_profile_response.userid')
                ->join('users as u', 'u.id', '=', 'online_profile_response.userid')
                //->join('user_panel as up', 'up.userid', '=', 'u.id')
                //->where('u.profilesubmitted', 1)
                ->where('u.active', 1)
                ->where('u.role', 1)
                ->where('u.year', 2023)
                ->orderBy('online_profile_response.name')
                ->get();
                return view('View_studentprofiles')->with('profile_list', $result);
    }

    //Allocate project to interns page
    public static function Allocate_Project(Request $request)
    {   $start_date = date('2022-05-01 00:00:00');
        $students = User::select('users.id','users.name', 'users.project_alloted','projectname')->where('users.role', 1)->where('users.active', 1)->where('profilesubmitted', 1) ->where('users.year', 2023) ->leftjoin('projects as p', 'p.id', '=', 'users.project_alloted')->orderby('name')->get();
        $projects = Projects::select('id','projectname')
                    ->where('active', 1)
                    ->orderBy('projectname')->get();
        $alloted_proj = User::join('projects as p', 'p.id', '=', 'users.project_alloted')
                        ->select('users.id','p.projectname')
                        ->get();
        log::info("inside allocate project");

        log::info($alloted_proj);
        return view('Allocate_Project')->with('students', $students)->with('projects', $projects)->with('alloted_proj', $alloted_proj);
    }

    //Submit Allocate project to interns page
    public static function AllocateProject_Submit($userid, $project)
    {
        log::info($userid);
        log::info($project);
        $approve = DB::table('users')
                      ->where('id', $userid)
                      ->update(['project_alloted' => $project]);
                    return back()->withStatus(__('Project allocation done successfully.'));
   }



    public static function Project_list()
    {   $start_date = date('2022-05-01 00:00:00');
        $projects = Projects::select('id','projectname','abstract','technologystack','interns_required','mentor1userid','mentor2userid','mentor3userid')
                    ->where('active', 1)
                    ->where('year', 2023)
                    ->orderBy('projectname')->get();
        return view('View_projects')->with('projects', $projects);

        
   }

   public function getProjectPrefernceByPanel(Request $request){
        $data = DB::table('projects')            
            ->select(DB::raw('
                projects.id, projects.projectname, projects.interns_required,
                (select count(*) from student_evaluation where projects.id = student_evaluation.projectpref1) as p1_count,
                (select count(*) from student_evaluation where projects.id = student_evaluation.projectpref2) as p2_count,
                (select count(*) from student_evaluation where projects.id = student_evaluation.projectpref3) as p3_count
            '))
            ->where('projects.id', '!=', 0)
            ->where('active',1)
            ->where('year', 2023)            
            ->get();

        return view('projectPreferenceByPanel')->with('projects', $data);
   }

   public function submitTrxDetails(Request $request){
        $validator = Validator::make($request->all() , [
            'trxDate' => 'required',
            'trxUTR' => 'required',
        ],[
            'trxDate.required' => 'Please mention your transaction Date',
            'trxUTR.required' => 'Mention your transaction reference number',
        ]);
            

        if($validator->fails()){
            return back()->withErrors($validator);
        } else {
            $intern = OnlineProfile::where('userid',Auth::user()->id)->first();
            
            $intern->trxDate = $request->trxDate;
            $intern->trxUTR = $request->trxUTR;            
            $intern->save();

            return back()->withStatus(__('Information saved successfully. Once we verifiy the transaction details, Will update the payment status.'));
        }
   }
}
