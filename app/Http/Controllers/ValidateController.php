<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;

use App\Model\Template;
use App\Model\Certificate;
use App\Model\Event;


class ValidateController extends Controller
{
    //
    public function index()
	{
		return view('validate');
	}

	public function verify(Request $request)
	{	
		$userDetailsId = $request->certiNumber;
		if(isset($_POST['number']))
		{
		  	/*Code for the number based certificate details */
		  	return "e-Yantra Certificate Verified !!!<br /> User Id: ".$userDetailsId."<br />Details Will be updated soon.";
		}
		else if(isset($_POST['hash']))
		{
		  	return 	$this->authenticate($userDetailsId);
		}
		else
			return view('errors.404');
		
	}
	/**
	 * Cdde for the QR (Hash) code based authentication of user.
	 *
	 * @return Response
	 */ 
	public function authenticate($id)
	{
		$record = \DB::table('certificates')->where(['hash' => $id])->first(); //extract matching hash value
		
		if(is_null($record) || empty($record)) 
		{
			$error_message= "Invalid Certificate Number";
			return view('errors.invalid', compact('error_message'));	
		}
		else
		{	
			if($record->validFlag == 0) //if certificate is vaild?not?
			{
				echo "e-Yantra Certificate Verified and Authenticated !!<br ><br >";
				$event = Event::find($record->event_id);
				$template  = Template::find($record->template_id);
				if(is_null($event) || is_null($template))
					return view('errors.invalid');
				echo "Event Title: ". $event->title;
				echo "<br >Certificate Title: ".$template->title; 
				echo "<br > Certificate Number: ". $record->hash. "<br > Date of Generation: ".$record->generated_at;
				echo "<br><br><b> Certificate Details: </b>".$record->keyValue."<br> ";
			}
			else
			{
				$error_message="Certificate Invalid";
				return view('errors.invalid', compact('error_message'));	
	

			}


		}

	}
}
