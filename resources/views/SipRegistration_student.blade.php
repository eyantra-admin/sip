<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
label{
  font-size: 17px;
}

		.tabs{
			background: #2ba0db;
		}

		.ui-tabs{
			border:none;
		}


.required:after {
   color: #e32;
   content: "* ";
  font-size: x-large;
}
body{
  padding-left: 10px;
    
}
hr {
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 1px;
}

.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid lightblue;
  border-bottom: 16px solid lightblue;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
</head>
<body>
	<!--header-->
  <nav class="navbar navbar-default navbar-fixed-top" style="min-height: 70px;">
    <div class="container">
      <div class="navbar-header">
        <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a href="http://e-yantra.org" class="navbar-brand" title="e-Yantra"><img src="{!! asset('/logo.png') !!}"/></a>
      </div>
    </div>
  </nav>


	<div class="container" style="padding-top: 60px">
	  <h2>{{$student->name}}</h2>

	  <a href="{{ url('/SipView') }}" style="font-size:24px; float:right" >Home</a>
	  
	  <ul class="nav nav-pills">
	    <li class="active"><a data-toggle="pill" href="#home" style="font-size:20px;">General</a></li>
	    <li><a data-toggle="pill" href="#menu1" style="font-size:20px;">Projects</a></li>
	    <li><a data-toggle="pill" href="#menu2" style="font-size:20px;">MOOC</a></li>
	    <li><a data-toggle="pill" href="#menu3" style="font-size:20px;">Experience Details</a></li>
	    <li><a data-toggle="pill" href="#menu4" style="font-size:20px;">e-Yantra Affiliations</a></li>
	    <li><a data-toggle="pill" href="#menu5" style="font-size:20px;">General Questions</a></li>
	  </ul>

	  
	  <div class="tab-content" style="background-image: url('69.jpg')">
	    <div id="home" class="tab-pane fade in active">
	    	 <div class="panel panel-default">
	 			<div class="panel-heading">
	 				<label>General Section</label>
	 			</div>
	 			<div class="panel-body">
	 
	 				<div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
		 				<label>Full Name</label>
		 				<input type="text" class="form-control" value= "{{$student->name}}" disabled>
		 				<input type="hidden" name="stu_id" id="stu_id" value="{{$student->userid}}"/>
	 				</div>

	 				<div class="form-group col-lg-5 form-group-lg col-lg-offset-1">
		 				<label>Email</label>
		 				<input type="text" class="form-control" disabled value= "{{$student->email}}">
		 			</div>

	 				<div class="form-group col-lg-5 form-group-lg">
		 				<label>Phone</label>
		 				<input type="text" class="form-control" disabled value= "{{$student->phone}}">
		 			</div>

	  				<div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
		 				<label>College</label>
		 				<input type="text" class="form-control" disabled value= "{{$student->college}}">
		 			</div>

	 				<div class="form-group col-lg-5 form-group-lg col-lg-offset-1">
		 				<label>Branch</label>
		 				<input type="text" class="form-control" disabled value= "{{$student->branch}}">
		 			</div>

	 				<div class="form-group col-lg-5 form-group-lg">
		 				<label>Year</label>
		 				<input type="text" class="form-control" disabled value= "{{$student->year}}">
		 			</div>

		 			<div class="form-group col-lg-5 form-group- col-lg-offset-1">
		 				<label>College Type</label>
		 				<input type="text" class="form-control" disabled value= "{{($student->collType) == 1? 'Private' : 'Public'}}">
		 			</div>
	 			</div>
	 		</div>

		   	<div class="panel panel-default">
	 			<div class="panel-heading">
	 				<label>Academic Records </label>
	 			</div>
	 			<div class="panel-body">
	 				<div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
		 				<label>Present GPA</label>
		 				<input type="text" class="form-control" disabled value= "{{$student->gpa}}">
		 			</div>

		 			<div class="form-group col-lg-5 form-group-lg col-lg-offset-1">
		 				<label>Class 12 or diploma Percentage</label>
		 				<input type="text" class="form-control" disabled value= "{{$student->class12}}">
		 			</div>

	 				<div class="form-group col-lg-5 form-group-lg">
		 				<label>Class 12 board or diploma</label>
		 				<input type="text" class="form-control" disabled value= "{{$student->class12board}}">
		 			</div>
	 			</div>
	 		</div>

		   	<div class="panel panel-default">
	 			<div class="panel-heading">
	 				<label>Social Presence (links will be shown if given by the student)</label>
	 			</div>
	 			<div class="panel-body">
	 				<div class="form-group col-lg-5 form-group-lg col-lg-offset-1">
		 				<label>Github Repository</label>	 				
		 				<a href="{{$student->github}}" target="=_blank" id="git">{{$student->github}}</a>
		 			</div>

		 			<div class="form-group col-lg-5 form-group-lg">
		 				<label>Instagram</label>
						<a href="{{$student->instagram}}" target="=_blank" id="insta">{{$student->instagram}}</a>	
		 			</div>

	 				<div class="form-group col-lg-5 form-group-lg col-lg-offset-1">
		 				<label>LinkedIn</label>				
		 				<a href="{{$student->linkedin}}" target="=_blank" id="linked">{{$student->linkedin}}</a>
		 			</div>

		 			<div class="form-group col-lg-5 form-group-lg">
		 				<label>Facebook</label>
		 				<a href="{{$student->facebook}}" target="=_blank" id="fb">{{$student->facebook}}</a>
		 			</div>
	 			</div>
	 		</div>


	    </div>
	    <div id="menu1" class="tab-pane fade">
	    	 <div class="panel panel-default">
	 			<div class="panel-heading">
	 				<label> Skill Ratings Description<br>
					Rookie - Have basic theoretical knowledge  |  Have completed MOOC Course related to skill.<br>
                    Novice - Have completed Lab Experiments or multiple Minor Projects related to skill | Possess good conceptual understanding of subject.<br>
                    Master - Have completed Major Projects | Have spent significant time developing skill (more than 6 months).<br>
                    Pro - Multiple Projects completed. Put dedicated long term effort on this skill).
	                </label>
	               </div>
	           </div>
	            <div class="panel panel-default" id="project1">
	            	<div class="panel-heading">
	 				<label>Project 1</label>
	 			</div>
	 			<div class="panel-body">
	 
	 				<div class="form-group col-lg-10 form-group-lg">
		 				<label>Project Title</label>
		 				<input type="text" class="form-control" value= "{{$project->project1_name}}" disabled>
	 				</div>

	 				<div class="form-group col-lg-10 form-group-lg">
		 			
	 					<label>Project Desc</label>
	 					<textarea class="form-control" disabled cols="50" rows="4">{{$project->project1_desc}}</textarea> 
	 				</div>
	 				
	 				<div class="form-group col-lg-10 form-group-lg">
		 			
	 					<label>Role</label>
	 					<textarea class="form-control" disabled >{{$project->project1role}}</textarea> 
	 				</div>

	 				<div class="form-group col-lg-5 form-group-lg">	 			
		 				<label>Members</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project1_members}}"> 					
	 				</div>
	 				<div class="form-group col-lg-5 form-group-lg">				
		 				<label>Github Repository</label>
	 					<a href="{{$project->project1_github}}" target="_blank" id="proj1_git">{{$project->project1_github}}</a>
	 				</div>
	 				<div class="form-group col-lg-10 form-group-lg">
						<label>Project Publication</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project1_publ}}">
	 				</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Skill 1</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project1_skills1}}">
		 			</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Rating 1</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project1_rating1}}">
		 			</div>

					<div class="form-group col-lg-5 form-group-lg">
						<label>Skill 2</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project1_skills2}}">
		 			</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Rating 2</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project1_rating2}}">
		 			</div>
		 			<div class="form-group col-lg-5 form-group-lg">
						<label>Skill 3</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project1_skills3}}">
		 			</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Rating 3</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project1_rating3}}">
		 			</div>
	 			</div>
	    	</div>

	    	 <div class="panel panel-default" id="project2">
	 			<div class="panel-heading">
	 				<label>Project 2</label>
	 			</div>
	 			<div class="panel-body">
	 
	 				<div class="form-group col-lg-10 form-group-lg">
		 				<label>Project Title</label>
		 				<input type="text" class="form-control" value= "{{$project->project2_name}}" disabled>
	 				</div>

	 				<div class="form-group col-lg-10 form-group-lg">
		 			
	 					<label>Project Desc</label>
	 					<textarea class="form-control" disabled cols="50" rows="4">{{$project->project2_desc}}</textarea> 
	 				</div>
	 				
	 				<div class="form-group col-lg-10 form-group-lg">
		 			
	 					<label>Role</label>
	 					<textarea class="form-control" disabled >{{$project->project2role}}</textarea> 
	 				</div>

	 				<div class="form-group col-lg-5 form-group-lg">	 			
		 				<label>Members</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project2_members}}"> 					
	 				</div>
	 				<div class="form-group col-lg-5 form-group-lg">				
		 				<label>Github Repository</label>
	 					<a href="{{$project->project2_github}}" target="_blank">{{$project->project2_github}}</a>
	 				</div>
	 				<div class="form-group col-lg-10 form-group-lg">
						<label>Project Publication</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project2_publ}}">
	 				</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Skill 1</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project2_skills1}}">
		 			</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Rating 1</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project2_rating1}}">
		 			</div>

					<div class="form-group col-lg-5 form-group-lg">
						<label>Skill 2</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project2_skills2}}">
		 			</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Rating 2</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project2_rating2}}">
		 			</div>
		 			<div class="form-group col-lg-5 form-group-lg">
						<label>Skill 3</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project2_skills3}}">
		 			</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Rating 3</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project2_rating3}}">
		 			</div>
	 			</div>
	 		</div>

	    	 <div class="panel panel-default" id="project3">
	 			<div class="panel-heading">
	 				<label>Project 3</label>
	 			</div>
	 			<div class="panel-body">
	 
	 				<div class="form-group col-lg-10 form-group-lg">
		 				<label>Project Title</label>
		 				<input type="text" class="form-control" value= "{{$project->project3_name}}" disabled>
	 				</div>

	 				<div class="form-group col-lg-10 form-group-lg">
		 			
	 					<label>Project Desc</label>
	 					<textarea class="form-control" disabled cols="50" rows="4">{{$project->project3_desc}}</textarea> 
	 				</div>
	 				
	 				<div class="form-group col-lg-10 form-group-lg">
		 			
	 					<label>Role</label>
	 					<textarea class="form-control" disabled >{{$project->project3role}}</textarea> 
	 				</div>

	 				<div class="form-group col-lg-5 form-group-lg">	 			
		 				<label>Members</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project3_members}}"> 					
	 				</div>
	 				<div class="form-group col-lg-5 form-group-lg">				
		 				<label>Github Repository</label>
	 					<a href="{{$project->project2_github}}" target="_blank" id="proj3_git">{{$project->project3_github}}</a>

	 				</div>
	 				<div class="form-group col-lg-10 form-group-lg">
						<label>Project Publication</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project3_publ}}">
	 				</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Skill 1</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project3_skills1}}">
		 			</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Rating 1</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project3_rating1}}">
		 			</div>

					<div class="form-group col-lg-5 form-group-lg">
						<label>Skill 2</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project3_skills2}}">
		 			</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Rating 2</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project3_rating2}}">
		 			</div>
		 			<div class="form-group col-lg-5 form-group-lg">
						<label>Skill 3</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project3_skills3}}">
		 			</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Rating 3</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project3_rating3}}">
		 			</div>
	 			</div>
	    	</div>

	    	 <div class="panel panel-default" id="project4">
	 			<div class="panel-heading">
	 				<label>Project 4</label>
	 			</div>
	 			<div class="panel-body">
	 
	 				<div class="form-group col-lg-10 form-group-lg">
		 				<label>Project Title</label>
		 				<input type="text" class="form-control" value= "{{$project->project4_name}}" disabled>
	 				</div>

	 				<div class="form-group col-lg-10 form-group-lg">
		 			
	 					<label>Project Desc</label>
	 					<textarea class="form-control" disabled cols="50" rows="4">{{$project->project4_desc}}</textarea> 
	 				</div>
	 				
	 				<div class="form-group col-lg-10 form-group-lg">
		 			
	 					<label>Role</label>
	 					<textarea class="form-control" disabled >{{$project->project4role}}</textarea> 
	 				</div>

	 				<div class="form-group col-lg-5 form-group-lg">	 			
		 				<label>Members</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project4_members}}"> 					
	 				</div>
	 				<div class="form-group col-lg-5 form-group-lg">				
		 				<label>Github Repository</label> 					
	 					<a href="{{$project->project4_github}}" target="_blank" id="proj4_git">{{$project->project4_github}}</a>

	 				</div>
	 				<div class="form-group col-lg-10 form-group-lg">
						<label>Project Publication</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project4_publ}}">
	 				</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Skill 1</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project4_skills1}}">
		 			</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Rating 1</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project4_rating1}}">
		 			</div>

					<div class="form-group col-lg-5 form-group-lg">
						<label>Skill 2</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project4_skills2}}">
		 			</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Rating 2</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project4_rating2}}">
		 			</div>
		 			<div class="form-group col-lg-5 form-group-lg">
						<label>Skill 3</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project4_skills3}}">
		 			</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Rating 3</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project4_rating3}}">
		 			</div>
	 			</div>
	    	</div>

	    	 <div class="panel panel-default" id="project5">
	 			<div class="panel-heading">
	 				<label>Project 5</label>
	 			</div>
	 			<div class="panel-body">
	 
	 				<div class="form-group col-lg-10 form-group-lg">
		 				<label>Project Title</label>
		 				<input type="text" class="form-control" value= "{{$project->project5_name}}" disabled>
	 				</div>

	 				<div class="form-group col-lg-10 form-group-lg">
		 			
	 					<label>Project Desc</label>
	 					<textarea class="form-control" disabled cols="50" rows="4">{{$project->project5_desc}}</textarea> 
	 				</div>
	 				
	 				<div class="form-group col-lg-10 form-group-lg">
		 			
	 					<label>Role</label>
	 					<textarea class="form-control" disabled >{{$project->project5role}}</textarea> 
	 				</div>

	 				<div class="form-group col-lg-5 form-group-lg">	 			
		 				<label>Members</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project5_members}}"> 			
	 				</div>
	 				<div class="form-group col-lg-5 form-group-lg">				
		 				<label>Github Repository</label>
	  					<a href="{{$project->project5_github}}" target="_blank" id="proj5_git">{{$project->project5_github}}</a>

	 				</div>
	 				<div class="form-group col-lg-10 form-group-lg">
						<label>Project Publication</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project5_publ}}">
	 				</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Skill 1</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project5_skills1}}">
		 			</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Rating 1</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project5_rating1}}">
		 			</div>

					<div class="form-group col-lg-5 form-group-lg">
						<label>Skill 2</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project5_skills2}}">
		 			</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Rating 2</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project5_rating2}}">
		 			</div>
		 			<div class="form-group col-lg-5 form-group-lg">
						<label>Skill 3</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project5_skills3}}">
		 			</div>
	 				<div class="form-group col-lg-5 form-group-lg">
						<label>Rating 3</label>
	 					<input type="text" class="form-control" disabled value= "{{$project->project5_rating3}}">
		 			</div>
	 			</div>
	    	</div>


	    </div>

	    
	    <div id="menu2" class="tab-pane fade">
		   	<div class="panel panel-default">
	 			<div class="panel-heading">
	 				<label>MOOC Coursework (if any)</label>
	 			</div>
	 			<div class="panel-body">
	 				<div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
		 				<label>Course Specialization Name</label>
		 				<input type="text" class="form-control" disabled value= "{{$student->mooc_course}}">
		 			</div>

		 			<div class="form-group col-lg-5 form-group-lg col-lg-offset-1">
		 				<label>Platform</label>
		 				<input type="text" class="form-control" disabled value= "{{$student->platform}}">
		 			</div>

		 			<div class="form-group col-lg-5 form-group-lg">
		 				<label>Number of courses started but not completed</label>
		 				<input type="text" class="form-control" disabled value= "{{$student->number_of_courses_incomplete}}">
		 			</div>

	 				<div class="form-group col-lg-5 form-group-lg col-lg-offset-1" id="cert_img_label">
		 				<label>Certificate Progress screenshot</label>
		 				<!-- <button  name="cert_img" id="cert_img" class="btn btn-info">Download</button>  --> 
		 				<!-- <a href="/downloadCertificate/?stu_id={{$student->id}}">download PDF</a> -->
		 				<a href="/downloadCertificate/{{$student->userid}}">download PDF</a>
		 					 				
		 			</div>

	 			</div>
	 		</div>
	    </div>
	    <div id="menu3" class="tab-pane fade">
		   	<div class="panel panel-default">
	 			<div class="panel-heading">
	 				<label>Experience Details</label>
	 			</div>
	 			<?php $i=1; ?>
	 			@foreach($exp as $ex)
	 			<div class="panel-body">
	 				<div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
		 				<label>Experience {{$i}}</label>
		 				<textarea class="form-control" disabled rows="10" cols="63">{{$ex->exp_description}}</textarea>   
		 			</div>
	 			</div>
	 			<?php $i+=1; ?>
	 			@endforeach
	 		</div>
	    </div>

	    <div id="menu4" class="tab-pane fade">
		   	<div class="panel panel-default">
	 			<div class="panel-heading">
	 				<label>e-Yantra Affiliations</label>
	 			</div>
	 			
	 			<div class="panel-body">
	 				<div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
		 				<label>e-Yantra inititative that student has participated in </label>
		 				<input type="text" class="form-control" disabled value= "{{$student->eyrc_eyic_participating}}">
		 			</div>

	 				<div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
		 				<label>eYRC Theme</label>
		 				<input type="text" class="form-control" disabled value= "{{$student->eyrc_theme}}">
		 			</div>

	 				<div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
		 				<label>Where is the hardware?</label>
		 				<input type="text" class="form-control" disabled value= "{{$student->where_is_your_hardware}}">
		 			</div>

		 			<div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
		 				<label>List of hardware that student has(other than theme kit) for immediate use in eYSIP. (ex. Microcontrollers, Sensors, Actuators, etc)</label>
		 				<input type="text" class="form-control" disabled value= "{{$student->otherhw}}">
		 			</div>

	 			</div>
	  		</div>
	    </div>

	    <div id="menu5" class="tab-pane fade">
	    	<div class="panel panel-default">
	    		<div class="panel-heading">
	    			<label>General Questions (questions are as appeared in the form)</label>
	    		</div>

	    		<div class="panel-body">
	 				<div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
		 				<label>1. Why should I be selected for this internship?</label>
		 				<textarea  class="form-control" disabled cols="50" rows="5">{{$student->why_select_for_intership}}</textarea>
		 			</div>

		 			<div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
		 				<label>2. What are your expectations from this remote internship?</label>
		 				<textarea  class="form-control" disabled cols="50" rows="5">{{$student->expectations_from_remote_intership}}</textarea>
		 			</div>

		 			<div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
		 				<label>3. What are your thoughts on remote internships?</label>
		 				<textarea  class="form-control" disabled cols="50" rows="5">{{$student->thoughts_on_remote_internship}}</textarea>
		 			</div>	 			

		 			<div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
		 				<label>4. Have you applied for an internship anywhere else? </label>
		 				<input  class="form-control" disabled value="{{$student->applied_for_other_internship}}">
		 			
		 			</div>	 			

		 			<div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
		 				<label>5. How will you troubleshoot any problem while working remotely? </label>
		 				<textarea  class="form-control" disabled cols="50" rows="5">{{$student->how_troubleshoot_remotely}}</textarea>
		 			</div>

		 			<div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
		 				<label>6. How do you work best ? </label>
		 				<input  class="form-control" disabled value="{{$student->individual_or_team_player}}">
		 			</div>
	    		</div>
	    	</div>
	    </div>
	  </div>
	</div>
</body>
</html>

<script type="text/javascript">

$(document).ready(function (){
	var file = '<?php echo $file; ?>';
	var userid = $('#userid').val();
//	console.log(userid);
	if(file == 1)
	{
		$('#cert_img_label').show();
	}
	else
	{			
		$('#cert_img_label').html("<label class='text-success'>No Certificate uploaded</label>");
	}
});	





</script>

