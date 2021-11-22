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
use App\Model\Projects;
use Auth;
use Log;
use File;


class Generate extends Controller
{
    
    public function run() //used for purpose of testing 
    {

    $student_details=OnlineProfile::where('userid',auth()->user()->id)->first();
    $project_name = Projects::where('id',auth()->user()->project_alloted)->first();
    $pdf = \App::make('dompdf.wrapper');
    
    $certi_details = Certificate::where('userid', $student_details->userid)->first();
    Log::info($certi_details);
    $cert_template= Template::where('id',1)->first();
    $cert_event = Event::where('id', 1)->first();
    
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
        
        $pdf->save(storage_path().'/certificate/eysip'.'/certi_'.$student_details->userid.'.pdf');
        
        return $pdf->stream('certificate.pdf');
        
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
