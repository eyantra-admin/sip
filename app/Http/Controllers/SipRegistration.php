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

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

use App\Model\OnlineProfile;
use App\Model\CollegeDetails;
use App\Model\ElsiDepartments;
use App\Model\ExperienceDtls;
use App\Model\StudentProjDtls;
use App\Model\skills_list;
use App\User;


class SipRegistration extends Controller {

	protected static $thisClass = 'SipRegistration';

	public function sip_view()
	{
		//log::Info('students view');
		$students = OnlineProfile::select('online_profile_response.id','name','email','phone','eyrc_eyic_participating', 'eyrc_theme','college','branch','year')
							->join('student_project_dtls as st','st.student_id','=','online_profile_response.id')
							//->where('online_profile_response.id','>',1)
							->distinct('online_profile_response.id')
							->get();

		return view('SipRegistration_view')->with('students',$students);
	}	

	public function sip_student(Request $request)
	{
		$stu_id = $request->stu_id;
		$student = OnlineProfile::where('id',$stu_id)->first();
		$project = StudentProjDtls::where('student_id',$stu_id)->first();

		$exp = ExperienceDtls::where('online_profileid',$stu_id)->get();
		$userid= $student->userid;
		$file = Storage::disk('local')->exists('/sip_mooc_upload/','Stu_'.$userid.'_MOOC.pdf');
		//$file = 0;
		log::info('------------');
		log::info($student);
		log::info($project);
		log::info($exp);


		return view('SipRegistration_student')->with('student',$student)->with('project',$project)->with('exp',$exp)->with('file',$file);
	}	

	public function download_certificate($studentid){
		log::info('-------//////////-----');
		$student = OnlineProfile::where('id',$studentid)->first();
		$userid= $student->userid;
		
		log::info($userid);
		$filename = 'Stu_'.$userid.'_MOOC.pdf';
		log::info($filename);
		// $response= Response::download(Config::get('constants.TBT_UPLOAD_FILES_LOC') . 'task1/TBT#'.$team_id.'.zip', 'TBT#'.$team_id.'.zip', ['content-type' => ['application/zip']]);
		// ob_end_clean();
		// return $response;
		$file=Storage::disk('local')->download('sip_mooc_upload/Stu_'.$userid.'_MOOC.pdf');
                    return $file;
                      

		//$file = Storage::disk('local')->exists('sip_mooc_upload/Stu_'.$userid.'_MOOC.pdf');
		// if ($file == 1)
		// 	return Storage::disk('local')->download($filename);
			  
		// else
		// 	return response()->json([
  //               'error' => "No certificates found."
  //           ], 404);
		//return Storage::disk('public')->download('letter-of-intent.docx');
	}

	public function registerload(){
		$colleges = CollegeDetails::select('clg_code','college_name')->orderBy('college_name')->get();
		$departments = ElsiDepartments::select('id', 'name')->orderBy('name')->get();
		$skills = skills_list::orderBy('skill')->get();
		$chksubmitted = User::where('email',Auth::user()->email)->first();
		//log::info($skills);

		return view('profile.SipRegistration')
				->with('colleges', $colleges)
				->with('departments',$departments)
				->with('skills', $skills)
				->with('form_submitted', $chksubmitted->profilesubmitted); 
		//return view ('SipRegistration_closed');
		}

	public function attachment_upload(Request $request){
		$file = $request->file('image');
		$file = $request->image;
		$fullname = $request->fullname;
		log::info($fullname);
		$extension = $request->image->extension();

/*		$recentid = OnlineProfile::max('id');
		$newid = $recentid + 1;*/
		$userid= Auth::user()->id;
		//$newfilename = 'Stu_'.$fullname.'_MOOC.'.$extension;
		$newfilename = 'Stu_'.$userid.'_MOOC.'.$extension;
		log::info($newfilename);
		$path = Storage::disk('local')->putFileAs('sip_mooc_upload',$file,$newfilename);

		return json_encode('image uploaded successfully');
	}
	


	public static function submitprofile(Request $request){
		$input = $request->all();
		log::info($request->all());
		$competition=$request->get('competition');

		$userid= Auth::user()->id;
		log::info($userid);

		$rules=[
		'fullname'	=> 'required',
		'phone' => 'required|numeric|digits_between:10,12',
		'phone.digits' => 'Phone number should be of 10 to 12 digits.',
		'email' => 'required',
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
						'fullname.required'	=> 'Full name is required',
						'email.required' => 'Email is required',
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

		if (!filter_var($request->github, FILTER_VALIDATE_URL) ) {
			//log::Info('inside error');
			return redirect()->route('SipRegistration')->withErrors('General profile github must be a URL');
		}
		
		DB::beginTransaction();		
			try
				{
					log::info('---------------');
					$col_name= CollegeDetails::select('college_name')->where('clg_code',$request->college)->first();
					$branch = ElsiDepartments::select('name')->where('id',$request->department)->first();

					$profile = new OnlineProfile;

					//student profile
					$profile->name = $request->fullname;
					$profile->email = $request->email;
					$profile->phone = $request->phone;
					$profile->year = $year;
					$profile->college = $col_name['college_name'];
					$profile->collType = $request->collType;
					$profile->clg_code = $request->college;
					$profile->year = $request->year;
					$profile->branch = $branch['name'];
					$profile->class12 = $request->class12;
					$profile->class12board = $board;
					$profile->gpa = $request->gpa;
					$profile->github = $request->github;
					$profile->linkedin = $request->linkedin;
					$profile->instagram = $request->insta;
					$profile->facebook = $request->fb;
/*					if(!$profile->save()){
						throw new Exception('Unable to save your data.');
					}

*/
					//MOOC section
					if(!empty ($request->moocCourseName))
						$profile->mooc_course = $request->moocCourseName;
					if(!empty($request->moocPlatform))
						$profile->platform = $request->moocPlatform;
					if(!empty($request->fileToUpload))
						$profile->certificate_progress_screenshot = $request->fileToUpload;
					if(!empty($request->moocIncomplete))
						$profile->number_of_courses_incomplete = $request->moocIncomplete;

					$recentid = OnlineProfile::max('id');	
					$newid = $recentid + 1;
					if(!empty($request->filename))
					{
						$imagename = 'Stu_'.$newid.'_MOOC'.$request->filename;
						$profile->certificate_progress_screenshot = $imagename;
					}


					//Projects Dtls
					//project 1
					$proj = new StudentProjDtls;
					$proj->student_id = $recentid + 1;
						
					if(!empty($request->projectTitle1))
					{
					//	log::Info('inside prject1');
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
							$proj->project1_skills1 = $s['skill'];
						}
						if(!empty($request->rating1_1))
							$proj->project1_rating1 = $request->rating1_1;
						if(!empty($request->skills2_1))
						{
							$s = skills_list::select('skill')->where('id', $request->skills2_1)->first();
							$proj->project1_skills2 = $s['skill'];
						}
						if(!empty($request->rating2_1))
							$proj->project1_rating2 = $request->rating2_1;
						if(!empty($request->skills3_1))
						{
							$s = skills_list::select('skill')->where('id', $request->skills3_1)->first();
							$proj->project1_skills3 = $s['skill'];
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
							$proj->project2_skills1 = $s['skill'];
						}

						if(!empty($request->rating1_2))
							$proj->project2_rating1 = $request->rating1_2;
						if(!empty($request->skills2_2))
						{
							$s = skills_list::select('skill')->where('id', $request->skills2_2)->first();
							$proj->project2_skills2 = $s['skill'];
						}
						if(!empty($request->rating2_2))
							$proj->project2_rating2 = $request->rating2_2;
						if(!empty($request->skills3_2))
						{
							$s = skills_list::select('skill')->where('id', $request->skills3_2)->first();
							$proj->project2_skills3 = $s['skill'];
						}
						if(!empty($request->rating3_2))
							$proj->project2_rating3 = $request->rating3_2;

						if(!empty($request->proj2Publ))
							$proj->project2_publ = $request->proj2Publ;

					}
					//Project 3
					if(!empty($request->projectTitle3))
					{
						$proj->student_id = $recentid + 1;
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
							$proj->project3_skills1 = $s['skill'];
						}
						if(!empty($request->rating1_3))
							$proj->project3_rating1 = $request->rating1_3;
						if(!empty($request->skills2_3))
						{
							$s = skills_list::select('skill')->where('id', $request->skills2_3)->first();
							$proj->project3_skills2 = $s['skill'];
						}
						if(!empty($request->rating2_3))
							$proj->project3_rating2 = $request->rating2_3;
						if(!empty($request->skills3_3))
						{
							$s = skills_list::select('skill')->where('id', $request->skills3_3)->first();
							$proj->project3_skills3 = $s['skill'];
						}
						if(!empty($request->rating3_3))
							$proj->project3_rating3 = $request->rating3_3;

						if(!empty($request->proj3Publ))
							$proj->project3_publ = $request->proj3Publ;

					}
					//Project 4
					if(!empty($request->projectTitle4))
					{
						$proj->student_id = $recentid + 1;
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
							$proj->project4_skills1 = $s['skill'];
						}
						if(!empty($request->rating1_4))
							$proj->project4_rating1 = $request->rating1_4;
						if(!empty($request->skills2_4))
						{
							$s = skills_list::select('skill')->where('id', $request->skills2_4)->first();
							$proj->project4_skills2 = $s['skill'];
						}
						if(!empty($request->rating2_4))
							$proj->project4_rating2 = $request->rating2_4;
						if(!empty($request->skills3_4))
						{
							$s = skills_list::select('skill')->where('id', $request->skills3_4)->first();
							$proj->project4_skills3 = $s['skill'];
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
							$proj->project5_skills1 = $s['skill'];
						}
						if(!empty($request->rating1_5))
							$proj->project5_rating1 = $request->rating1_5;
						if(!empty($request->skills2_5))
						{
							$s = skills_list::select('skill')->where('id', $request->skills2_5)->first();
							$proj->project5_skills2 = $s['skill'];
						}
						if(!empty($request->rating2_5))
							$proj->project5_rating2 = $request->rating2_5;
						if(!empty($request->skills3_5))
						{
							$s = skills_list::select('skill')->where('id', $request->skills3_5)->first();
							$proj->project5_skills3 = $s['skill'];
						}
						if(!empty($request->rating3_5))
							$proj->project5_rating3 = $request->rating3_5;

						if(!empty($request->proj5Publ))
							$proj->project5_publ = $request->proj5Publ;
					}

					if(!empty($request->otherPubl))
						$proj->otherPubl = $request->otherPubl;

					$proj->save();
					if(!$proj->save()){
						throw new Exception('Unable to save your data.');
					}

					//Section 3 answers
					$profile->eyrc_eyic_participating = $request->get('competition');
					$profile->eyrc_theme = $request->get('theme');	
					$profile->where_is_your_hardware = $request->get('hardware');
					$profile->otherhw = $request->get('otherhw');
/*					if(!$profile->save()){
						throw new Exception('Unable to save your data.');
					}
*/					//Section 4 answers
					$exp=$request->expdtl;
					if(!empty ($exp))
					{
						foreach($exp as $exp)
						{
						//	log::info($exp);	
							if(!empty($exp))
							{
								log::info('**********************');
								$exp_dtls = new ExperienceDtls;	
								$recentid = OnlineProfile::max('id');
								log::info($recentid);				
								$exp_dtls->exp_description = $exp;
								$exp_dtls->online_profileid = $recentid + 1;	
								// $exp_dtls->save();
								if(!$exp_dtls->save())
								{
									throw new Exception('Unable to save your data.');
								}
							}									
						}						
					}
					
					//Section 5 answers
				//	log::info($request->get('whyselect'));
					$profile->why_select_for_intership = $request->get('whyselect');	
					$profile->expectations_from_remote_intership = $request->get('expectations');	
					$profile->thoughts_on_remote_internship	 = $request->get('thoughts');
					$profile->how_troubleshoot_remotely	 = $request->get('troubleshoot');
					$profile->applied_for_other_internship = $request->get('applyintern');
					$profile->individual_or_team_player = $request->get('workbest');

					$profile->userid= Auth::user()->id;
				//	log::info($profile);

					$profile->save();

					$exp_dtls->save();

					$user = User::where('id', Auth::user()->id)->first();
					$user->profilesubmitted = 1;
					$user->save();

					DB::commit();
					if(!$profile->save())
					{						
						
					}						
			}
			catch(exception $e){
				DB::rollBack();
				return redirect()->route('SipRegistration')->with(['status'=>"profile not added something went wrong"]);
			}
		}
		//project.preference
			return redirect()->route('SipRegistration')->with(['status'=>"Successfully submitted!!"]);	
	}


}