<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Session;
use App\Model\Template;
use App\Model\Certificate;
use App\Model\OnlineProfile;
use App\Model\ElsiCollegeDtls;
use App\Model\StudentProjDtls;
use App\Model\CertMapping;
use App\Model\Event;
use App\User;
use App\Model\Projects;
use Auth;
use Log;
use File;


class Generate extends Controller
{
    
    public function run() //used for purpose of testing 
    {
    $students = OnlineProfile::where('cert_level', 1)->whereIn('userid',[341,342,322,389,296,334,375,345,396,347,424,325,339,410,313,384,309,301,354,374,298,286,415,357,416,350,353,305,431,338,381,391,289,291,421,369,315,356,290,321,333,69,283,358,335,429,371,344,306,425,326,392,328,330,346,361,314,413,385,398,404,285,399,295,294,302,303,287,403,332,377,368,340,300,359,364,323,355,387,412,299,423,308])->get();

    foreach ($students as $studs) {
    $student_details=OnlineProfile::where('userid',$studs->userid)->first();
    $user_project = User::where('id',$studs->userid)->first();
    $project_name = Projects::where('id',$user_project->project_alloted)->first();
    $pdf = \App::make('dompdf.wrapper');
    
    $certi_details = Certificate::where('userid', $student_details->userid)->first();
    Log::info($certi_details);
    $cert_template= Template::where('id',3)->first();
    $cert_event = Event::where('id', 3)->first();
    
    if (!empty($certi_details)) {
        # code...
        $random = $certi_details->random;
        $hash = $certi_details->hash;
        }
    else
    {
        $random = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 8);
        $rand_value =  $random.Carbon::now()->day;
        $hash = sha1($rand_value);
    }
    
     //hash value unique code of certificate
    $arr=[
        'name' => $student_details->name,
        'college_name'=>$student_details->college,
        'project_name'=>$project_name->projectname,
        'duration'=>$student_details->proj_duration
        ];
    $keyvalue=  json_encode($arr);

    $certificate = Certificate::updateorCreate(['userid' => $student_details->userid]);
            //Log::info($certificate);
            $certificate->userid = $student_details->userid;
            $certificate->template_id = $cert_template->id;
            $certificate->event_id = $cert_event->id; 
            $certificate->userDetailsId = $student_details->userid;   
            $certificate->hash = $hash;
            $certificate->random = $random;
            $certificate->keyValue = $keyvalue;
            $certificate->digitalFlag= 1;           
            $certificate->generated_at = Carbon::now();
            $certificate->save();
            /*Certificate Table*/

    if ($student_details->cert_level == 1) {
        # code...
        $pdf->loadView('template.student_merit' , compact('cert_template','cert_event','student_details', 'hash','project_name', 'certi_details'));

        $path = storage_path().'/certificate/eysip/'.$student_details->userid;
        if (!File::exists($path)) {
            # code...
            File::makeDirectory($path, 0777, true, true);

        }
        log::info($path);
        
        $pdf->save(storage_path().'/certificate/eysip2022'.'/certi_'.$student_details->userid.'.pdf');
    }
    
        
/*        return $pdf->stream('certificate.pdf');
*/        
        }
    }




    public function store()
   	{
   		/*---Load the Certificate Data for Storage in Database   */
   		$pdf = \App::make('dompdf');
    	$data = \Session::get('data');
    	$line_of_text = $data['line_of_text'];
	  	$template = $data['template'];
	 	$updatebody = $data['updatebody'];
	 	$keyValuePair = $data['keyValuePair'];
	 	$template_id = $data['template_id'];
	 	$event_id = $data['event_id'];
	 	$randomValue = $data['randomValue'];
	 	$hashValue = $data['hashValue'];
	 	$userDetailsId = $data['userDetailsId'];
	 	$signFlag = $data['signFlag'];

   		if((isset($_POST['store']))) //store and display the generated certificates
		{	
			\Session::flash('flash_message', 'Certificates has been generated successfully');  			
	  		 return view('generate.success', compact('data'));	
		}
		else
		{
			return view('errors.404');
		}
   	}
}