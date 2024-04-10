<?php namespace App\Http\Controllers;

use Auth;
use Validator;
use Session;
use Config;
use DateTime;
use Hash;
use Mail;
use Log;
use DB;
use Storage;
use Redirect;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use App\Model\OnlineProfile;
use App\Model\CollegeDetails;
use App\Model\ElsiDepartments;
use App\Model\ExperienceDtls;
use App\Model\StudentProjDtls;
use App\Model\skills_list;
use App\User;
use Illuminate\Support\Facades\Crypt;


class SipRegistration extends Controller 
{

	protected static $thisClass = 'SipRegistration';

	public function sip_view()
	{
		$students = OnlineProfile::select('online_profile_response.id','online_profile_response.userid','name','email','phone','eyrc_eyic_participating', 'eyrc_theme','college','branch','year')
							->join('student_project_dtls as st','st.userid','=','online_profile_response.userid')
							->distinct('online_profile_response.id')
							->get();
		return view('SipRegistration_view')->with('students',$students);
	}


	public function sip_student($userid)
	{
		
		$student = OnlineProfile::where('userid',Crypt::decrypt($userid))->first();

		$project = StudentProjDtls::where('userid',Crypt::decrypt($userid))->first();
		$exp = ExperienceDtls::where('userid',Crypt::decrypt($userid))->get();
		$file = Storage::disk('local')->exists('/sip_mooc_upload/','Stu_'.Crypt::decrypt($userid).'_MOOC.pdf');
		return view('SipRegistration_student')->with('student',$student)->with('project',$project)->with('exp',$exp)->with('file',$file);
	}
	public function ViewMyRegistration($userid)
	{
		$student = OnlineProfile::where('userid',Crypt::decrypt($userid))->first();
		$skills = skills_list::orderBy('skill')->get();
		$project = StudentProjDtls::where('userid',Crypt::decrypt($userid))->get();
		$exp = ExperienceDtls::where('userid',Crypt::decrypt($userid))->get();
		// $file = Storage::disk('local')->exists('/sip_mooc_upload/','Stu_'.$userid.'_MOOC.pdf');
		return view('profile.View_MyRegistration')->with('student',$student)->with('project',$project)->with('skills',$skills)->with('exp',$exp);
		//->with('file',$file);
	}
		

	public function download_certificate($userid)
	{
		$student = OnlineProfile::where('userid',$userid)->first();
		$filename = 'Stu_'.$userid.'_MOOC.pdf';
		//log::info($filename);

		$file=Storage::disk('local')->download('sip_mooc_upload/Stu_'.$userid.'_MOOC.pdf');
                    return $file;
	}

	public function registerload()
	{
		$colleges = CollegeDetails::select('clg_code','college_name')->orderBy('college_name')->get();
		$departments = ElsiDepartments::select('id', 'name')->orderBy('name')->get();
		$skills = skills_list::orderBy('skill')->get();
		$chksubmitted = User::where('email',Auth::user()->email)->first();
		$data_exsits = OnlineProfile::firstOrCreate(['email' => Auth::user()->email, 'userid' => Auth::user()->id]);
		//dd($data_exsits);
		return view('StudentProfileForm')
				->with('colleges', $colleges)
				->with('departments',$departments)
				->with('skills', $skills)
				->with('data_exsits', $data_exsits)
				->with('form_submitted', $chksubmitted->profilesubmitted);
				//->with('stud_data', $stud_data); 
		// return view ('SipRegistration_closed');
		}



		public function OldSipRegistration()
	{
		$colleges = CollegeDetails::select('clg_code','college_name')->orderBy('college_name')->get();
		$departments = ElsiDepartments::select('id', 'name')->orderBy('name')->get();
		$skills = skills_list::orderBy('skill')->get();
		$chksubmitted = User::where('email',Auth::user()->email)->first();

		return view('OldSipRegistration')
				->with('colleges', $colleges)
				->with('departments',$departments)
				->with('skills', $skills)
				->with('form_submitted', $chksubmitted->profilesubmitted); 
		}

	public function attachment_upload(Request $request){
		$file = $request->file('image');
		$file = $request->image;
		$fullname = $request->fullname;
		//log::info($fullname);
		$extension = $request->image->extension();

		$userid= Auth::user()->id;
		$newfilename = 'Stu_'.$userid.'_MOOC.'.$extension;
		//log::info($newfilename);
		$path = Storage::disk('local')->putFileAs('sip_mooc_upload',$file,$newfilename);

		return json_encode('image uploaded successfully');
	}

	public function checkfunction()
	{
		$userid = User::where('email', Auth::user()->email)->value('id');
		$already_exists = OnlineProfile::where('userid', $userid)->count();
		$tabcnt = OnlineProfile::where('userid', $userid)->value('tabcount');
	}


	//Section wise submit form
	public function submitSection1(Request $request) // GENERAL INFO
	{
		//log::info($request->all());
		$input = $request->all();
		$validator = Validator::make($request->all(), [
      		'fullname' => 'required|min:5|regex:/(^[A-Za-z ]+$)+/',
      		'phone' => 'required|numeric|digits_between:10,12',
			'phone.digits' => 'Phone number should be of 10 to 12 digits.',
			'college' => 'required',
			'department' => 'required',
			'year' => 'required',
			'class12' => 'required|numeric|between:0,99.99',
			'gpa' => 'required|numeric|between:0,99.99',
			'github' => 'required'                   
    ],
    [
    		'phone.digits' => 'Phone number should be of 10 to 12 digits',
			'phone.required' => 'Phone number is required',
			'college.required' => 'College is required',
			'department.required' => 'Department is required',
			'year.required' => 'Current year at college required',
			'class12.required' => 'Class 12 percentage required',
			'gpa.required' => 'Current GPA required',
			'github.required' => 'Github account required'
    ]);

    if($validator->fails())
    {
    	//log::info('VALIDATOR FAIL');
      	return Redirect::back()->withErrors($validator);
    }
		else
		{		
			$userid = User::where('email', Auth::user()->email)->value('id');
			switch($request->year) 
			{
					case "1": $year = "first year"; break;
					case "2": $year = "second year"; break;
					case "3": $year = "third year"; break;
					case "4": $year = "fourth year"; break;
				}
			switch($request->class12board) 
			{
				case "1": $board = "HSC"; break;
				case "2": $board = "CBSE"; break;
				case "3": $board = "ICSE"; break;
				case "4": $board = "IGCSE"; break;
				case "5": $board = "IB"; break;
				case "6": $board = "Diploma"; break;
			}
			
			$already_exists = OnlineProfile::where('userid', $userid)->count();
			$col_name= CollegeDetails::select('college_name')->where('clg_code',$request->college)->first();
			$branch = ElsiDepartments::select('name')->where('id',$request->department)->first();

			$profile = new OnlineProfile;
			if($already_exists == 1)
      {
        $basicdtls = DB::table('online_profile_response')
                ->where('userid', $userid)
                ->update([
                		  'name' => $request->fullname,	
                		  'gpa' => $request->gpa, 
                          'year' => $request->year, 
						  'phone' => $request->phone, 
                          'branch' => $branch['name'], 
                          'clg_code' => $request->college,
                          'college' => $col_name['college_name'],  
                          'collType' => $request->collType,
                          'class12' => $request->class12, 
                          'class12board' => $request->class12board,
                          'github' => $request->github, 
                          'linkedin' => $request->linkedin,
                          'instagram' => $request->insta, 
                          'facebook' => $request->fb,
                          'tab1count' => 1
                          ]);
        return redirect()->route('SipRegistration')->withStatus(__('Academic details updated successfully.'));
      }
      else
      {
    		$profile->userid = $userid;
				$profile->name = $request->fullname;
				$profile->email = $request->email;
				$profile->phone = $request->phone;
				$profile->year = $request->year;
				$profile->college = $col_name['college_name'];
				$profile->collType = $request->collType;
				$profile->clg_code = $request->college;
				
				$profile->branch = $branch['name'];
				$profile->class12 = $request->class12;
				$profile->class12board = $request->class12board;
				$profile->gpa = $request->gpa;
				$profile->github = $request->github;
				$profile->linkedin = $request->linkedin;
				$profile->instagram = $request->insta;
				$profile->facebook = $request->fb;
				$profile->tab1count = 1;
				$profile->save();

				return redirect()->route('SipRegistration')->withStatus(__('Academic details submitted successfully.'));
			}
			return redirect()->route('SipRegistration')->withStatus(__('Academic details added successfully.'));
    }
	}
//-----------------------------END OF SECTION 1------------------------------------------------
	PUBLIC function submitSection2(Request $request) // PROJECT DTLS
	{
		//log::info($request->all());
		/*$validator = Validator::make($request->all(), [
	      'projectTitle.*' => 'required|min:5|regex:/(^[A-Za-z ]+$)+/',
				
	    ],
	    [
	    	'projDuration.digits' => 'Project duration is a numeric field.',
				'projMembers.digits' => 'Project members is a numeric field.',    
	    ]);

	    if($validator->fails())
	    {
	    	log::info('VALIDATOR FAIL');
	      return Redirect::back()->withErrors($validator);
	    }*/

			$userid = User::where('email', Auth::user()->email)->value('id');
			$tab1cnt = OnlineProfile::where('userid', $userid)->value('tab1count');
			if($tab1cnt == 1)
			{
	      $proj = new StudentProjDtls;
				for ($i=0; $i < count($request['projectTitle']); ++$i) 
				{
					$proj = new StudentProjDtls;
					//log::info('-----');
					//log::info($request['projectTitle'][$i]);
			    $proj->projectTitle = $request['projectTitle'][$i];
			    $proj->projDesc= $request['projDesc'][$i];
			    $proj->projDuration= $request['projDuration'][$i];
			    $proj->projMembers = $request['projMembers'][$i];
			    $proj->projectRole= $request['projectRole'][$i];
			    $proj->projGithub= $request['projGithub'][$i];
			    $proj->projPubl = $request['projPubl'][$i];
			    $proj->skills1= $request['skills1'][$i];
			    $proj->rating1= $request['rating1'][$i];
			    $proj->skills2= $request['skills2'][$i];
			    $proj->rating2= $request['rating2'][$i];
			    $proj->skills3= $request['skills3'][$i];
			    $proj->rating3= $request['rating3'][$i];
			    $proj->userid= Auth::user()->id;	
			    $proj->save();  
				}
				$update_tabcount = DB::table('online_profile_response')->where('userid', $userid)
	                  			->update(['tab2count' => 1]);
	    	return redirect()->route('SipRegistration')->withStatus(__('Projects added successfully.'));
			}
			else
			{
				return back()->withErrors(__('Please submit the details from tab 1 in order to submit project details.'));
			}				
	}
//-----------------------------END OF SECTION 2------------------------------------------------
	PUBLIC FUNCTION submitSection3(Request $request)// MOOC COURSES
	{
		//log::info($request->all());
		$validator = Validator::make($request->all(), [
				
				'moocIncomplete' => 'numeric|digits_between:0,10'                 
      ],
      [
				'moocIncomplete.digits' => 'Mooc Incomplete should only contain digits'
      ]);

      if($validator->fails())
      {
        return back()->withErrors($validator);
      }
			$userid =  Auth::user()->id;
			$tab1cnt = OnlineProfile::where('userid', $userid)->value('tab1count');
	    $tab2cnt = OnlineProfile::where('userid', $userid)->value('tab2count');
	    //log::info($tab1cnt);
	    //log::info($tab2cnt);
			if($tab1cnt != 1 && $tab2cnt != 1)
			{
				log::info('TAB NOT');
				return back()->withErrors('Please submit the details from Tab 1 & Tab 2 in order to submit project details.');
			}
			else
			{
				if((!empty ($request->moocCourseName)) || (!empty($request->moocPlatform)) ||	
      	(!empty($request->moocIncomplete)))
	      {			log::info("inside if of mooc course");
					$profile = new OnlineProfile;
	        $basicdtls = DB::table('online_profile_response')
	                  ->where('userid', $userid)
	                  ->update([
	                  	'mooc_course' => $request->moocCourseName, 
	                    'platform' => implode(',', $request->moocPlatform), 
	                    'number_of_courses_incomplete' => $request->moocIncomplete,
	                    'tab3count' => 1
	                    ]);
	        return redirect()->route('SipRegistration')->withStatus(__('Mooc Courses added successfully.'));
				}
			}
	}
	//-----------------------------END OF SECTION 3------------------------------------------------
	PUBLIC FUNCTION submitSection4(Request $request)//EXP DTL
	{
		//log::info('----In section 4-----');
		$userid =  Auth::user()->id;
		$tab1cnt = OnlineProfile::where('userid', $userid)->value('tab1count');
    $tab2cnt = OnlineProfile::where('userid', $userid)->value('tab2count');
    //log::info($tab1cnt);
    //log::info($tab2cnt);
		if($tab1cnt == 1 || $tab2cnt == 1)
		{
			$expvalue=$request->expdtl[0];
			$exp=$request->expdtl;
			if(!empty($expvalue))
			{
				foreach($exp as $exp)
				{	
					if(!empty($exp))
					{
						//log::info('**********************');
						$exp_dtls = new ExperienceDtls;				
						$exp_dtls->exp_description = $exp;
						$exp_dtls->userid = Auth::user()->id;	
						if(!$exp_dtls->save())
						{
							throw new Exception('Unable to save your data.');
						}
					}									
				}				
			}
			//---------------------------------------------------------------------------------------
			$update_tabcount = DB::table('online_profile_response')
                  ->where('userid', $userid)
                  ->update(['tab4count' => 1]);
			return redirect()->route('SipRegistration')->withStatus(__('Experiences added successfully.'));
		}
		else
		{
			return back()->withErrors(__('Please submit the details from Tab 1, Tab 2 & Tab 3 in order to submit experience details.'));
		}
	}
	//-----------------------------END OF SECTION 4------------------------------------------------
	public function submitSection5(Request $request) // EYANTRA affiliation
	{
		//log::info($request->all());

    $rules = [
							'competition'=>'required',
							'theme' => $request->competition=="eyrc"?'required':'',
							'hardware' =>  $request->competition=="eyrc"?'required':''
						];
		$messages = ['competition.required' => 'Mention your affiliation with e-Yantra'];
		$validate=Validator::make($request->all(),$rules,$messages);
		if($validate->fails())
		{
			//log::info('-------Validator FAIL--------');
			return back()->withErrors(__('Mention your affiliation with e-Yantra'));
		}
		else
		{	
			$userid =  Auth::user()->id;	
			$already_exists = OnlineProfile::where('userid', $userid)->count();
			// $tabcnt = OnlineProfile::where('userid', $userid)->value('tabcount');
			//checkfunction();
			$profile = new OnlineProfile;
			if($already_exists == 1)
      {
        $basicdtls = DB::table('online_profile_response')
                ->where('userid', $userid)
                ->update([
                	'eyrc_eyic_participating' => $request->competition, 
                  'eyrc_theme' => $request->theme, 
                  'where_is_your_hardware' => $request->hardware, 
                  'otherhw' => $request->otherhw,
                  'tab5count' =>  1
                  ]);
        return redirect()->route('SipRegistration')->withStatus(__('e-Yantra affiliations added successfully.'));
      }
      else
      {

				return back()->withErrors(__('Please submit the profile on tab 1.'));
			}
    }
	}

	//-----------------------------END OF SECTION 5------------------------------------------------
	public function submitSection6(Request $request) // EYANTRA affiliation
	{
		$input = $request->all();
		$validator = Validator::make($request->all(), [
			'exam_start' => 'required|date_format:d-m-Y',
			'exam_end' => 'required|date_format:d-m-Y',		
			'NuOfLeaves' => 'required|numeric|max:6',	
		],
		[
			'exam_start.required' => 'Exam Start Date is required',
			'exam_end.required' => 'Exam End Date is required',
			'NuOfLeaves.required' => 'Mention number of leaves',
			'NuOfLeaves.numeric' => 'Mention number 0-6 only',
			'exam_start.date_format' => 'Exam Start Date: Enter valid date',
			'exam_end.date_format' => 'Exam End Date: Enter Valid date',
			'NuOfLeaves.max' => 'Enter number between 0:6',
		]);

		if($validator->fails()){
	      	return Redirect::back()->withErrors($validator);
	    }

		$userid =  Auth::user()->id;	
		$tab1cnt = OnlineProfile::where('userid', $userid)->value('tab1count');
	    $tab2cnt = OnlineProfile::where('userid', $userid)->value('tab2count');
	    $tab4cnt = OnlineProfile::where('userid', $userid)->value('tab4count');
	    $tab5cnt = OnlineProfile::where('userid', $userid)->value('tab5count');

		if($tab1cnt == 1 && $tab2cnt == 1 && $tab4cnt == 1 && $tab5cnt == 1){
			//$profile = new OnlineProfile;
			$basicdtls = DB::table('online_profile_response')
                ->where('userid', $userid)
                ->update([
                	'exam_start' => $request->exam_start, 
                  	'exam_end' => $request->exam_end, 
                  	'nu_leaves' => $request->NuOfLeaves,
                ]);

      		$confirm = DB::table('users')
                ->where('id', $userid)
                ->update(['profilesubmitted' => 1 ]);
      		return redirect()->route('SipRegistration')->withStatus(__('Details submitted successfully.'));
    	} else {
				return back()->withErrors(__('Please submit the information asked in all mandatory tabs to complete your profile submission.'));
		}
	}

	public static function submitprofile(Request $request){
		$input = $request->all();
		//log::info($request->all());
		$competition=$request->get('competition');

		$userid= Auth::user()->id;
		//log::info($userid);

		$rules=[
		// 'fullname'	=> 'required',
		'phone' => 'required|numeric|digits_between:10,12',
		'phone.digits' => 'Phone number should be of 10 to 12 digits.',
		// 'email' => 'required',
		'college' => 'required',
		'department' => 'required',
		'year' => 'required',
		'class12' => 'required',
		'class12board' => 'required',
		'gpa' => 'required',
		'github' => 'required',

		'projectTitle1' => 'required',
		'projDesc1' => 'required',
		'projDesc1' => 'required|string|max:600',
		'projDuration1' => 'required|numeric|max:12|min:1|not_in:0',
		'projMembers1' => 'required:numeric|min:1',
		'projectRole1' => 'required|string|max:200',
		'proj1Publ' => 'nullable|string:max:200',
		'skills1_1' => 'required',
		'skills2_1' => 'required',
		'skills3_1' => 'required',
		'rating1_1' => 'required',
		'rating2_1' => 'required',
		'rating3_1' => 'required',


		'projDuration2' => 'nullable|numeric|max:12|min:1|not_in:0',
		'projMembers2' => 'nullable|numeric|min:1',
		'projDuration3' => 'nullable|numeric|max:12|min:1|not_in:0',
		'projMembers3' => 'nullable|numeric|min:1',
		'projDuration4' => 'nullable|numeric|max:12|min:1|not_in:0',
		'projMembers4' => 'nullable|numeric|min:1',
		'projDuration5' => 'nullable|numeric|max:12|min:1|not_in:0',
		'projMembers5' => 'nullable|numeric|min:1',
		'projDesc2' => 'nullable|string|max:600',
		'projDesc3' => 'nullable|string|max:600',
		'projDesc4' => 'nullable|string|max:600',
		'projDesc5' => 'nullable|string|max:600',

		'projectRole2' => 'nullable|string|max:200',
		'projectRole3' => 'nullable|string|max:200',
		'projectRole5' => 'nullable|string|max:200',
		'projectRole1' => 'nullable|string|max:200',
		'proj2Publ' => 'nullable|string:max:200',
		'proj3Publ' => 'nullable|string:max:200',
		'proj4Publ' => 'nullable|string:max:200',
		'proj5Publ' => 'nullable|string:max:200',
		'moocIncomplete' => 'nullable|numeric',

		'expdtl' => 'required',

		'competition'=>'required',
		'theme' => $competition=="eyrc"?'required':'',
		'hardware' => $competition=="eyrc"?'required':'',
		'whyselect' => 'required',
		'expectations' => 'required',
		'thoughts' => 'required',
		//'applyintern' => 'required',
		'workbest' => 'required',
		'troubleshoot' => 'required',
			];

		$messages = [  	'expdtl.required' => 'Experience details is required',
						'theme.required' =>  'Theme name is required',
						'hardware.required' => 'Enter hardware information',
						'whyselect.required' => 'Question 1 in General Questions section is required',
						'expectations.required' => 'Question 2 in General Questions section is required',
						'thoughts.required' => 'Question 3 in General Questions section is required',
						//'applyintern.required' => 'Question 4 in General Questions section is required',
						'troubleshoot.required' => 'Question 5 in General Questions section is required',
						'workbest.required' => 'Question 6 in General Questions section is required',
						// 'fullname.required'	=> 'Full name is required',
						// 'email.required' => 'Email is required',
						'phone.digits' => 'Phone number should be of 10 to 12 digits',
						'phone.required' => 'Phone number is required',
						'college.required' => 'College is required',
						'department.required' => 'Department is required',
						'year.required' => 'Current year at college required',
						'class12.required' => 'Class 12 percentage required',
						'class12board.required' => 'Class 12 board required',
						'gpa.required' => 'Current GPA required',
						'github.required' => 'Github account required',
						'projectTitle1.required' => 'Add atleast 1 project title',
						'projDesc1.required' => 'Add atleast 1 project Description',
						'projMembers1.required' => 'Add members for atleast 1 project',
						'skills1_1.required' => 'Enter first skill for atleast 1 project',
						'skills2_1.required' => 'Enter second skill for atleast 1 project',
						'skills3_1.required' => 'Enter third skill for atleast 1 project',
						'competition.required' => 'Mention your affiliation with e-Yantra',
						'projDuration1.numeric' => 'Project 1 duration should be between than 1 to 12 months',
						'projDuration2.numeric' => 'Project 1 duration should be between than 1 to 12 months',
						'projDuration3.numeric' => 'Project 1 duration should be between than 1 to 12 months',
						'projDuration4.numeric' => 'Project 1 duration should be between than 1 to 12 months',
						'projDuration5.numeric' => 'Project 1 duration should be between than 1 to 12 months',
					];

		$validate=Validator::make($request->all(),$rules,$messages);

		if($validate->fails())
		{
			return redirect()->route('SipRegistration')->withErrors($validate)->withInput($input);
		}
		else
		{		
			switch($request->year) {
					case "1": $year = "first year"; break;
					case "2": $year = "second year"; break;
					case "3": $year = "third year"; break;
					case "4": $year = "fourth year"; break;
				}
			switch($request->class12board) {
					case "1": $board = "HSC"; break;
					case "2": $board = "CBSE"; break;
					case "3": $board = "ICSE"; break;
					case "4": $board = "IGCSE"; break;
					case "5": $board = "IB"; break;
					case "6": $board = "Diploma"; break;
				}

		// if (!filter_var($request->github, FILTER_VALIDATE_URL) ) {
		// 	//log::Info('inside error');
		// 	return redirect()->route('SipRegistration')->withErrors('General profile github must be a URL');
		// }
		
		//check if user already exists
		// if(Auth::user()->id->exists(OnlineProfile))
		// {
		// 	return redirect()->route('SipRegistration')->withErrors('You have already submitted your form.');
		// }
		//End of user already exsists		

		DB::transaction(function() use ($request)
		{
				//log::info('---------------');
				$col_name= CollegeDetails::select('college_name')->where('clg_code',$request->college)->first();
				$branch = ElsiDepartments::select('name')->where('id',$request->department)->first();

				$profile = new OnlineProfile;

				$profile->name = $request->fullname;
				$profile->email = $request->email;
				$profile->phone = $request->phone;
				$profile->year = $request->year;
				$profile->college = $col_name['college_name'];
				$profile->collType = $request->collType;
				$profile->clg_code = $request->college;
				
				$profile->branch = $branch['name'];
				$profile->class12 = $request->class12;
				$profile->class12board = $request->class12board;
				$profile->gpa = $request->gpa;
				$profile->github = $request->github;
				$profile->linkedin = $request->linkedin;
				$profile->instagram = $request->insta;
				$profile->facebook = $request->fb;

				if(!empty ($request->moocCourseName))
					$profile->mooc_course = $request->moocCourseName;
				if(!empty($request->moocPlatform))
					$profile->platform = $request->moocPlatform;
				if(!empty($request->fileToUpload))
					$profile->certificate_progress_screenshot = $request->fileToUpload;
				if(!empty($request->moocIncomplete))
					$profile->number_of_courses_incomplete = $request->moocIncomplete;

			
				$stud = Auth::user()->id;
				if(!empty($request->filename))
				{
					$imagename = 'Stu_'.$stud.'_MOOC'.$request->filename;
					$profile->certificate_progress_screenshot = $imagename;
				}

				//project 1
				$proj = new StudentProjDtls;
					
				if(!empty($request->projectTitle1))
				{
					$proj->userid = Auth::user()->id;

					$proj->project1_name =  $request->projectTitle1;
					if(!empty($request->projDesc1))
						$proj->project1_desc = $request->projDesc1 ;
					if(!empty($request->projMembers1))
						$proj->project1_members = $request->projMembers1;
					if(!empty($request->projectRole1))
						$proj->project1role =  $request->projectRole1;
					if(!empty($request->projDuration1))
						$proj->project1_duration = $request->projDuration1;
					if(!empty($request->projGithub1))
						$proj->project1_github = $request->projGithub1;
					if(!empty($request->skills1_1)){
						$s = skills_list::select('skill')->where('id', $request->skills1_1)->first();	
						if($s != null)
						{
							$proj->project1_skills1 = $s['skill'];
						}
					}
					if(!empty($request->rating1_1))
						$proj->project1_rating1 = $request->rating1_1;
					if(!empty($request->skills2_1))
					{
						$s = skills_list::select('skill')->where('id', $request->skills2_1)->first();
						if($s != null)
						{
							$proj->project1_skills2 = $s['skill'];
						}
					}
					if(!empty($request->rating2_1))
						$proj->project1_rating2 = $request->rating2_1;
					if(!empty($request->skills3_1))
					{
						$s = skills_list::select('skill')->where('id', $request->skills3_1)->first();
						if($s != null)
						{$proj->project1_skills3 = $s['skill'];}
					}
					if(!empty($request->rating3_1))
						$proj->project1_rating3 = $request->rating3_1;

					if(!empty($request->proj1Publ))
						$proj->project1_publ = $request->proj1Publ;
				}
				//Project2
				if(!empty($request->projectTitle2))
				{
					$proj->project2_name =  $request->projectTitle2;
					if(!empty($request->projDesc2))
						$proj->project2_desc = $request->projDesc2 ;
					if(!empty($request->projMembers2))
						$proj->project2_members = $request->projMembers2;
					if(!empty($request->projectRole2))
						$proj->project2role =  $request->projectRole2;
					if(!empty($request->projDuration2))
						$proj->project2_duration = $request->projDuration2;
					if(!empty($request->projGithub2))
						$proj->project2_github = $request->projGithub2;
					if(!empty($request->skills1_2))
					{
						$s = skills_list::select('skill')->where('id', $request->skills1_2)->first();
						if($s != null)
						{$proj->project2_skills1 = $s['skill'];}
					}

					if(!empty($request->rating1_2))
						$proj->project2_rating1 = $request->rating1_2;
					if(!empty($request->skills2_2))
					{
						//log::info('========================');
						//log::info($request->skills2_2);
						$s = skills_list::select('skill')->where('id', $request->skills2_2)->first();
						if($s != null)
						{
							$proj->project2_skills2 = $s['skill'];
						}
					}
					if(!empty($request->rating2_2))
						$proj->project2_rating2 = $request->rating2_2;
					if(!empty($request->skills3_2))
					{
						$s = skills_list::select('skill')->where('id', $request->skills3_2)->first();
						if($s != null)
						{$proj->project2_skills3 = $s['skill'];}
					}
					if(!empty($request->rating3_2))
						$proj->project2_rating3 = $request->rating3_2;

					if(!empty($request->proj2Publ))
						$proj->project2_publ = $request->proj2Publ;
				}
				//Project 3
				if(!empty($request->projectTitle3))
				{
					$proj->project3_name =  $request->projectTitle3;
					if(!empty($request->projDesc3))
						$proj->project3_desc = $request->projDesc3 ;
					if(!empty($request->projMembers3))
						$proj->project3_members = $request->projMembers3;
					if(!empty($request->projectRole3))
						$proj->project3role =  $request->projectRole3;
					if(!empty($request->projDuration3))
						$proj->project3_duration = $request->projDuration3;
					if(!empty($request->projGithub3))
						$proj->project3_github = $request->projGithub3;
					if(!empty($request->skills1_3))
					{
						$s = skills_list::select('skill')->where('id', $request->skills1_3)->first();
						if($s != null)
						{$proj->project3_skills1 = $s['skill'];}
					}
					if(!empty($request->rating1_3))
						$proj->project3_rating1 = $request->rating1_3;
					if(!empty($request->skills2_3))
					{
						$s = skills_list::select('skill')->where('id', $request->skills2_3)->first();
						if($s != null)
						{$proj->project3_skills2 = $s['skill'];}
					}
					if(!empty($request->rating2_3))
						$proj->project3_rating2 = $request->rating2_3;
					if(!empty($request->skills3_3) || ($request->skills3_3 != 'null'))
					{
						$s = skills_list::select('skill')->where('id', $request->skills3_3)->first();
						if($s != null)
						{$proj->project3_skills3 = $s['skill'];}
					}
					if(!empty($request->rating3_3))
						$proj->project3_rating3 = $request->rating3_3;

					if(!empty($request->proj3Publ))
						$proj->project3_publ = $request->proj3Publ;
				}
				//Project 4
				if(!empty($request->projectTitle4))
				{
					$proj->userid = Auth::user()->id;	
					$proj->project4_name =  $request->projectTitle4;
					if(!empty($request->projDesc4))
						$proj->project4_desc = $request->projDesc4 ;
					if(!empty($request->projMembers4))
						$proj->project4_members = $request->projMembers4;
					if(!empty($request->projectRole4))
						$proj->project4role =  $request->projectRole4;
					if(!empty($request->projDuration4))
						$proj->project4_duration = $request->projDuration4;
					if(!empty($request->projGithub4))
						$proj->project4_github = $request->projGithub4;
					if(!empty($request->skills1_4))
					{
						$s = skills_list::select('skill')->where('id', $request->skills1_4)->first();
						if($s != null)
						{$proj->project4_skills1 = $s['skill'];}
					}
					if(!empty($request->rating1_4))
						$proj->project4_rating1 = $request->rating1_4;
					if(!empty($request->skills2_4))
					{
						$s = skills_list::select('skill')->where('id', $request->skills2_4)->first();
						if($s != null)
						{$proj->project4_skills2 = $s['skill'];}
					}
					if(!empty($request->rating2_4))
						$proj->project4_rating2 = $request->rating2_4;
					if(!empty($request->skills3_4))
					{
						$s = skills_list::select('skill')->where('id', $request->skills3_4)->first();
						if($s != null)
						{$proj->project4_skills3 = $s['skill'];}
					}
					if(!empty($request->rating3_4))
						$proj->project4_rating3 = $request->rating3_4;

					if(!empty($request->proj4Publ))
						$proj->project4_publ = $request->proj4Publ;
				}
				//Project 5
				if(!empty($request->projectTitle5))
				{
					$proj->project5_name =  $request->projectTitle5;
					if(!empty($request->projDesc5))
						$proj->project5_desc = $request->projDesc5 ;
					if(!empty($request->projMembers5))
						$proj->project5_members = $request->projMembers5;
					if(!empty($request->projectRole5))
						$proj->project5role =  $request->projectRole5;
					if(!empty($request->projDuration5))
						$proj->project5_duration = $request->projDuration5;
					if(!empty($request->projGithub5))
						$proj->project5_github = $request->projGithub5;
					if(!empty($request->skills1_5))
					{
						$s = skills_list::select('skill')->where('id', $request->skills1_5)->first();
						if($s != null)
						{$proj->project5_skills1 = $s['skill'];}
					}
					if(!empty($request->rating1_5))
						$proj->project5_rating1 = $request->rating1_5;
					if(!empty($request->skills2_5))
					{
						$s = skills_list::select('skill')->where('id', $request->skills2_5)->first();
						if($s != null)
						{$proj->project5_skills2 = $s['skill'];}
					}
					if(!empty($request->rating2_5))
						$proj->project5_rating2 = $request->rating2_5;
					if(!empty($request->skills3_5))
					{
						$s = skills_list::select('skill')->where('id', $request->skills3_5)->first();
						if($s != null)
						{$proj->project5_skills3 = $s['skill'];}
					}
					if(!empty($request->rating3_5))
						$proj->project5_rating3 = $request->rating3_5;

					if(!empty($request->proj5Publ))
						$proj->project5_publ = $request->proj5Publ;
				}

				if(!empty($request->otherPubl))
					$proj->otherPubl = $request->otherPubl;

				//Section 3 answers
				$profile->eyrc_eyic_participating = $request->get('competition');
				$profile->eyrc_theme = $request->get('theme');	
				$profile->where_is_your_hardware = $request->get('hardware');
				$profile->otherhw = $request->get('otherhw');

				//Section 4 answers
				$expvalue=$request->expdtl[0];
				$exp=$request->expdtl;
				//log::info($expvalue);
				if(!empty($expvalue))
				{
					foreach($exp as $exp)
					{	
						if(!empty($exp))
						{
							log::info('**********************');
							$exp_dtls = new ExperienceDtls;				
							$exp_dtls->exp_description = $exp;
							$exp_dtls->userid = Auth::user()->id;	
							if(!$exp_dtls->save())
							{
								throw new Exception('Unable to save your data.');
							}
						}									
					}						
				}
				else
				{
					return redirect()->back()->withErrors('Add Atleast one experience details');
				}
				
				$profile->why_select_for_intership = $request->get('whyselect');	
				$profile->expectations_from_remote_intership = $request->get('expectations');	
				$profile->thoughts_on_remote_internship	 = $request->get('thoughts');
				$profile->how_troubleshoot_remotely	 = $request->get('troubleshoot');
				$profile->applied_for_other_internship = $request->get('applyintern');
				$profile->individual_or_team_player = $request->get('workbest');

				$profile->userid= Auth::user()->id;
				$profile->save();

				$exp_dtls->save();

				$proj->save();
				if(!$proj->save()){
					throw new Exception('Unable to save your data.');
				}

				$user = User::where('id', Auth::user()->id)->first();
				$user->profilesubmitted = 1;
				$user->save();
		}); // End transaction

		//return redirect()->route('/dashboard')->with(['status'=>"Successfully submitted!!"]);	
		return Redirect::route('dashboard');
		}
	}

	public function back()
	{
		if(Auth::user()->role == 2) //mentor
		{
			return redirect()->route('Evaluation');
		}
		elseif(Auth::user()->role == 3) //admin
		{
			return redirect()->route('View_profiles');
		}
		else                      //student
		{
			return redirect()->route('dashboard');
		}
	}

}