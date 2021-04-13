<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="_token" content="{!! csrf_token() !!}"/>

  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>@yield('title')</title>
  <!-- Bootstrap -->
  <link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
  <link href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
   <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
  <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
  <!-- Bootstrap Date-Picker Plugin -->
 
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto:400,700');
*{ box-sizing: border-box;}
button:active, button:focus{ outline: none; box-shadow: none;}
body{ background: #f2ccfc; font-family: 'Roboto', sans-serif;}
.multitab-form-area { max-width: 1000px; margin: 0 auto; background:#eee; padding: 5px}
.form-field input:focus, .form-field input:active, .form-field select:focus, .form-field select:active, .form-field textarea:active, .form-field textarea:focus {outline: 1px solid #8aa71c;}
.tab-links-area {width: 240px; display: inline-block; vertical-align: top; padding-right: 20px;}
.tab-form-area { width: calc(100% - 245px); display: inline-block; background: #fff; vertical-align: top; padding: 16px; border-radius: 5px;}
.tab-links-area p {margin: 0; font-size: 14px; color: #999;}
.tab-links-area h1 { margin: 0; font-size: 24px;}
.tab-part h4 {font-size: 24px;margin: 0;}
.multitab-form-area hr {border: 0; height: 1px; width: 100%; background: rgba(0,0,0,0.3);}
.tab-links-area ul li a {text-decoration: none;font-size: 14px;padding: 10px 15px;display: block;color: #333; position: relative;}
.tab-links-area ul li a:before {content: '';height: 0%;width: 3px;background: #8aa71c;position: absolute;left: -2px;top: 0;bottom: 0;margin: auto;transition: 0.3s ease;}
.tab-links-area ul li a.active:before{ height: 100%;}
.tab-links-area ul li {display: block; border-left: 1px solid #eee;}
.tab-links-area ul {list-style: none;padding: 0; margin: 20px 0 0;}
.form-field input, .form-field select {width: 100%; font-family: 'Roboto', sans-serif; height: 35px; padding-left: 10px; border: 1px solid #ccc;}
.form-field select {padding: 0 0 0 2px;}
.form-field label { font-size: 14px; display: block; padding:10px 0;}
.half-2 {width: 50%; padding: 0 10px; float: left;}
.devider-row:after {content: '';display: table;clear: both;}
.devider-row {margin: 0 -10px;clear: both;}
.half-3 {width: calc(100%/3); float: left; padding: 0 10px;}
.next-btn button, .next-btn a {background: #8aa71c;cursor: pointer;border: 1px solid #8aa71c;transition: 0.3s ease;color: #fff;height: 35px;width: 90px;border-radius: 100px;margin: 20px 0 10px auto;display: block;text-transform: uppercase;text-align: center;line-height: 35px;text-decoration: none;font-size: 14px;}
.next-btn button:hover, .next-btn a:hover {background: transparent; color: #8aa71c;}
.tabs-panels.active { display: block;}
.tabs-panels { display: none; animation: fadeIn 0.3s ease;}
.full {padding: 0 10px; width: 100%;}
.form-field textarea {width: 100%;height: 100px;padding: 10px;font-size: 14px;border: 1px solid #ccc;font-family: 'Roboto', sans-serif;}
.checkbox label:after {content: '';position: absolute;border-style: solid;border-color: #333;height: 8px;width: 5px;border-width: 0 3px 3px 0;left: 5px;z-index: 2;transform: rotate(35deg);top: 4px; display: none;}
.checkbox label:before {content: '';height: 20px;width: 21px;background: #fff;position: absolute;border: 1px solid #8aa71c;left: -2px;top: 0;border-radius: 3px;}
.checkbox {position: relative;margin: 10px 0;}
.checkbox label {display: inline-block;vertical-align: middle;padding: 0;}
.checkbox input[type="checkbox"] {width: 20px;height: 20px;display: inline-block;vertical-align: middle;margin: 0;position: relative;z-index: 3;opacity: 0;}
.radio label:after { content: ''; display: none; height: 15px; width: 15px; position: absolute; background: #8aa71c; border-radius: 100px; left: 2px; top: 2px; z-index: 1;}
.radio label:before {content: ''; height: 21px;  width: 21px; background: #fff; border: 1px solid #8aa71c; position: absolute; left: -2px; top: -2px; border-radius: 100px;}
.radio input[type="radio"] { height: 20px; width: 20px; display: inline-block; margin: 0; position: relative; z-index: 3; opacity: 0; vertical-align: middle;}
.radio label {padding: 0; display: inline-block;  margin: 0; vertical-align: middle;}
.radio { position: relative;  margin: 10px 0;}
.radio input:checked + label:after, .checkbox input:checked + label:after{ display: block;}
.note p { margin: 0; font-size: 12px; color: #999;}
.form-area {max-width: 80%; margin: 0 auto; background: #eee; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.25)} 
.form-footer p {margin: 0; font-size: 12px;}
.form-footer {padding: 20px; text-align: center; color: #676767;}
.form-header {background: #fff; box-shadow: 0 2px 7px rgba(0,0,0,0.1); margin-bottom: 20px;}
.logo-area {padding: 0 10%;}
.logo-area h1 a {color: #000; text-decoration: none; outline: none;}
.logo-area h1 {margin: 0; font-size: 18px;}
.need-help a i {background: #333; color: #fff; font-style: normal; font-size: 10px; height: 13px; width: 13px; display: inline-block; text-align: center; border-radius: 100px;}
.need-help a {font-size: 12px; color: #333; text-decoration: none;}
.need-help {text-align: right; padding: 0 10%;}
.top-header {padding: 15px 0; border-bottom: 2px dashed #ccc;}
.status p {font-size: 12px; color: #676767}
.status h5, .status p { margin: 0;}
.bars label { text-align: center; display: block; font-size: 14px;}
.bars {position: relative;}
.blank-bar {width: 100%; background: #ccc; height: 3px; border-radius: 100px;}
.full-bar { width: 50%; background: #8aa71c; height: 3px; position: relative; bottom: -3px;}
.bars span { height: 8px; width: 8px; display: inline-block; position: absolute; background: #ccc; border-radius: 100px; z-index: 1;}
.bars span:nth-of-type(2) {left: 15%;}
.bars span:nth-of-type(3) {left: 50%;}
.bars span:nth-of-type(4) {left: 85%;}
.bars span:nth-of-type(5) {left: 100%;}
.bars span.active{background: #8aa71c;}
.bottom-header {padding: 15px 10%;}
.status {padding-left: 10%;}
/*keyframes*/
@-webkit-keyframes fadeIn {
  0% {
    opacity: 0;
  }

  100% {
    opacity: 1;
  }
}

@keyframes fadeIn {
  0% {
    opacity: 0;
  }

  100% {
    opacity: 1;
  }
}

.fadeIn {
  -webkit-animation-name: fadeIn;
  animation-name: fadeIn;
}

@media(max-width:1000px){
    .half-2 {width: 100%;}
    .top-header .half-2 {width: 50%;}
    .logo-area {padding: 0 5%; text-align: left;}
    .status { padding-top: 20px; padding-left: 0;}
}

@media(max-width:1000px){
    .tab-links-area {width: 100%;display: block; margin-bottom: 20px;}
    .tab-form-area{ width: 100%;}
    .bottom-header {padding: 15px 5%;}
}

@media(max-width:5000px){
    .form-area {max-width: 100%;}
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

<div class="row">
<div class="col-md-8 col-md-offset-2" style ="padding-top: 70px;">

<div class="form-area">
    <div class="form-header">
        <div class="top-header">
            <div class="devider-row">
                <div class="half-2">
                    <div class="logo-area">
                        <h1><center><p>Summer Internship 2021</p></center></h1>
                    </div>
                </div>
                <div class="half-2">
                </div>
            </div>
        </div>
    </div> @if(Session::has('status'))
        <h5 class='alert alert-success' align="center">{{Session::get('status')}}</h5>
    @endif


@if($form_submitted != 1)
<form action="{{route('submitprofile')}}" method="post" name="profiledtls" novalidate>
     <input type="hidden" name="_token" value="{{csrf_token()}}"/>

      @if($errors->any())
      <div class="alert alert-danger" role='alert'>
      @foreach($errors->all() as $error)
      <p class="text-danger">{!!$error!!}</p>
      @endforeach
      </div>
      <hr/>
      @endif
    <div class="form-body">   
        <div class="multitab-form-area">
          <div class="tab-links-area">
              <h1>Student profile form</h1>
              <hr>
              <ul>
                  <li><a data-toggle="formtab" href="#userProfile" class="active">General Profile</a></li>
                  <li><a data-toggle="formtab" href="#projects">Projects</a></li>
                  <li><a data-toggle="formtab" href="#mooc">MOOC Courses</a></li>
                  <li><a data-toggle="formtab" href="#eyrceyic">e-Yantra Affiliations</a></li>
                  <li><a data-toggle="formtab" href="#expdtls">Experience Details</a></li>
                  <li><a data-toggle="formtab" href="#generalques">General Questions</a></li>
              </ul>
          </div>
            <div class="tab-form-area">
              <div class="tabs-panels active" id="userProfile">
                  <div class="tab-part">
                      <h4>General Profile </h4>
                      <hr>
                      <label> * Required fields </label>
                      <div class="devider-row">
                          <div class="form-field">
                              <label>Full Name *</label>
                              <input type="text" id="fullname" name="fullname" placeholder="Enter your name" value="{{ old('fullname', auth()->user()->name) }}" disabled="true">
                          </div>
                      </div>
                      <div class="devider-row">
                          <div class="half-2">                                
                              <div class="form-field">
                                  <label>Email ID *</label>
                                  <input type="email"  id="email" name="email" placeholder="Enter email id" value="{{old('email', auth()->user()->email)}}" disabled="true">                                    
                              </div>
                          </div>
                          <div class="half-2">
                              <div class="form-field">    
                                  <label>Phone *</label>
                                  <input type="number" min="0" id="phone" name="phone" placeholder="Type phone number"  value="{{old('phone')}}">
                              </div>
                          </div>
                      </div>
                      <div class="devider-row">
                          <div class="form-field">
                              <label>College *</label>
                              <select class="form-control" id="college" name="college" value="{{old('college')}}">
                                  <option hidden>Select your college</option>
                                    @foreach($colleges as $college)
                                      <option value="{{$college->clg_code}}" {{old('college') == $college->clg_code ? 'selected' : ''  }}>{{$college->college_name}}</option>
                                    @endforeach
                              </select>
                          </div>
                      </div>
                      <div class="devider-row">
                          <div class="half-2">
                              <div class="form-field">
                                  <label>Year *</label>
                                  <select id="year" class="form-control" name="year">
                                      <option hidden>Select year</option>
                                      <option value="1" {{old('year') == 1 ? 'selected': '' }}>First year</option>
                                      <option value="2" {{old('year') == 2 ? 'selected': '' }}>Second year</option>
                                      <option value="3" {{old('year') == 3 ? 'selected': '' }}>Third year</option>
                                      <option value="4" {{old('year') == 4 ? 'selected': '' }}>Fourth year</option>
                                  </select>
                              </div>
                              <div class="form-field">
                                  <label>Department *</label>
                                  <select class="form-control" id="department" name="department" value="{{old('department')}}">
                                      <option hidden>Select department</option>
                                        @foreach($departments as $department)
                                          <option value="{{$department->id}}" {{old('department') == $department->id ? 'selected' : ''  }}>{{$department->name}}</option>
                                        @endforeach
                                  </select>
                              </div>
                          </div>
                          
                          <div class="half-2">
                              <div class="form-field">
                                  <label>College Type *</label>
                                  <select class="form-control" id="collType" name="collType">
                                      <option hidden>Select College Type</option>
                                      <option value="1" {{old('collType') == 1 ? 'selected': '' }}>Private</option>
                                      <option value="2" {{old('collType') == 2 ? 'selected': '' }}>Public</option>
                              </select>
                              </div>
                          </div>
                      </div>
                      <br><br>
                      <div class="devider-row">  
                          <h4>Academic details</h4>
                          <hr>
                          <div class="half-2">
                              <div class="form-field">
                                  <label>Present GPA/ Percentage *</label>
                                  <input type="number" id="gpa" name="gpa" placeholder="Enter present GPA" value="{{old('gpa')}}">
                              </div>
                          </div>
                      </div>
                      <div class="devider-row">
                          <div class="half-2">
                              <div class="form-field">
                                  <label>Class 12 or diploma percentage *</label>
                                  <input type="text" id="class12" name="class12" placeholder="Enter percentage" value="{{old('class12')}}">
                              </div>
                          </div>
                          <div class="half-2">
                              <div class="form-field">
                                  <label>Class 12 Board *</label>
                                  <select id="class12board" class="form-control" name="class12board" value="{{old('class12board')}}">
                                      <option hidden>Select</option>
                                      <option value="1" {{ old('class12board') == 1 ? 'selected': '' }}>HSC</option>
                                      <option value="2" {{ old('class12board') == 2 ? 'selected': '' }}>CBSE</option>
                                      <option value="3" {{ old('class12board') == 3 ? 'selected': '' }}>ICSE</option>
                                      <option value="4" {{ old('class12board') == 4 ? 'selected': '' }}>IGCSE</option>
                                      <option value="5" {{ old('class12board') == 5 ? 'selected': '' }}>IB</option>
                                      <option value="6" {{ old('class12board') == 6 ? 'selected': '' }}>Diploma</option>
                                  </select>
                              </div>
                          </div>

                      </div>    
                      <br><br>
                      <div class="devider-row">
                          <h4>Social Presence</h4>
                          <hr>
                          <div class="half-2">
                              <div class="form-field">
                                  <label>Github Link*</label>
                                  <input type="text" id="github" name="github" placeholder="github.com/abc" value="{{old('github')}}"><!-- onchange="isUrlValid(this);" -->
                              </div>
                              <div class="form-field">
                                  <label>LinkedIn</label>
                                  <input type="text" id="linkedin" name="linkedin" placeholder="Enter LinkedIn info" value="{{old('linkedin')}}">
                              </div>
                          </div>
                          <div class="half-2">
                              <div class="form-field">
                                  <label>Instagram</label>
                                  <input type="text" id="insta" name="insta" placeholder="Enter instagram info" value="{{old('insta')}}">
                              </div>
                              <div class="form-field">
                                  <label>Facebook</label>
                                  <input type="text" id="fb" name="fb" placeholder="Enter facebook info" value="{{old('fb')}}">
                              </div>
                          </div>
                      </div>
                      
                  </div>
                  <div class="next-btn">
                      <a data-toggle="formtab" href="#projects">Next</a>
                  </div>
              </div>

                <div class="tabs-panels" id="projects">
                    <div class="tab-part">
                        <!-- Project 1 -->
                        <h4>Project 1</h4>
                        <h5>(You can enter atleast 1 project and maximum 5 projects in this section)</h5>
                        <hr>
                        <div class="devider-row">
                            <div class="form-field">
                                <label>Project title *</label>
                                <input type="text" id= "projectTitle1" name="projectTitle1" value="{{old('projectTitle1')}}">
                            </div>
                            <div class="form-field">
                                <label>Brief description * (upto 600 characters)</label>
                                <textarea id= "projDesc1" name="projDesc1" rows="6" cols="50">{{old('projDesc1') }}</textarea>
                            </div>                            
                        </div>

                        <div class="devider-row">
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Time duration (in months) *</label>
                                    <input type="number" id= "projDuration1" name="projDuration1" value="{{old('projDuration1')}}">
                                </div>
                            </div>
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Number of team members *</label>
                                    <input type="number" id= "projMembers1" name="projMembers1" value="{{old('projMembers1')}}">
                                </div>
                            </div>                      
                        </div>
                        <div class="devider-row">
                            <div class="form-field">
                                <label>Your role in the project * (upto 200 characters)</label>
                                <textarea id= "projectRole1" name="projectRole1" >{{old('projectRole1') }}</textarea>
                            </div>
                            <div class="form-field">
                                <label>Github repository of the project (if available)</label>
                                <input type="text" id= "projGithub1" name="projGithub1" value="{{old('projGithub1')}}" onchange="isUrlValid1(this);">
                            </div>  

                            <div class="form-field">
                                <label>Publications (if any). Enter details of you publications.
                                (Link can also be added here) (Upto 200 characters)</label>
                                <textarea id="proj1Publ" name="proj1Publ" rows="4" cols="50" >{{old('proj1Publ') }}</textarea>
                            </div>                          
                        </div>
                        <div class="devider-row">                            
                               <label><br><br>List upto three skills acquired during project and rate yourself as described below<br>
                                    Rookie - Have basic theoretical knowledge | Have completed MOOC Course related to skill<br>
                                    Novice - Have completed Lab Experiments or multiple Minor Projects related to skill | Possess good conceptual understanding of subject<br>
                                    Master - Have completed Major Projects | Have spent significant time developing skill (more than 6 months)<br>
                                    Pro - Multiple Projects completed. Put dedicated long term effort on this skill )</label>

                        </div>
                        <div class="devider-row">
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Skills acquired *</label>
                                    <select class="form-control" id="skills1_1" name="skills1_1" value="{{old('skills1_1')}}">
                                    <option hidden>Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}" {{old('skills1_1') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-field">
                                    <label>Skills acquired *</label>
                                    <select class="form-control" id="skills2_1" name="skills2_1" value="{{old('skills2_1')}}">
                                    <option hidden>Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{old('skills2_1') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-field">
                                    <label>Skills acquired *</label>
                                    <select class="form-control" id="skills3_1" name="skills3_1" value="{{old('skills3_1')}}">
                                    <option hidden>Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{old('skills3_1') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Rating for skill1 *</label>
                                    <select class="form-control" name="rating1_1" id= "rating1_1">
                                        <option hidden>Select</option>
                                        <option value="Rookie" {{old('rating1_1') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                        <option value="Novice" {{old('rating1_1') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                        <option value="Master" {{old('rating1_1') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="Pro" {{old('rating1_1') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>                                
                                <div class="form-field">
                                    <label>Rating for skill2 *</label>
                                    <select class="form-control" name="rating2_1" id= "rating2_1" >
                                        <option  hidden>Select</option>
                                        <option value="Rookie" {{old('rating2_1') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                        <option value="Novice" {{old('rating2_1') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                        <option value="Master" {{old('rating2_1') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="Pro" {{old('rating2_1') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>                                
                                <div class="form-field">
                                    <label>Rating for skill3 *</label>
                                    <select class="form-control" name="rating3_1" id= "rating3_1" value="{{old('rating3_1')}}">
                                        <option hidden>Select</option>
                                        <option value="Rookie" {{old('rating3_1') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                        <option value="Novice" {{old('rating3_1') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                        <option value="Master" {{old('rating3_1') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="Pro" {{old('rating3_1') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>                            
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <!-- project 2 -->
                    <div class="tab-part">
                        <h4>Project 2</h4>
                        <hr>
                        <div class="devider-row">
                            <div class="form-field">
                                <label>Project title </label>
                                <input type="text" id= "projectTitle2" name="projectTitle2" value="{{old('projectTitle2')}}">
                            </div>
                            <div class="form-field">
                                <label>Brief description (upto 600 characters)</label>
                                
                                <textarea id= "projDesc2" name="projDesc2" rows="6" cols="50">{{old('projDesc2') }}</textarea>
                            </div>                            
                        </div>

                        <div class="devider-row">
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Time duration (in months) </label>
                                    <input type="number" id= "projDuration2" name="projDuration2" value="{{old('projDuration2')}}">
                                </div>
                            </div>
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Number of team members </label>
                                    <input type="number" id= "projMembers2" name="projMembers2" value="{{old('projMembers2')}}">
                                </div>
                            </div>                      
                        </div>
                        <div class="devider-row">
                            <div class="form-field">
                                <label>Your role in the project  (upto 200 characters)</label>
                                <textarea id= "projectRole2" name="projectRole2">{{old('projectRole2') }}</textarea>
                            </div>
                            <div class="form-field">
                                <label>Github reporsitory of the project (if available)</label>
                                <input type="text" id= "projGithub2" name="projGithub2" value="{{old('projGithub2')}}" onchange="isUrlValid2(this);">
                            </div>  
                            <div class="form-field">
                                <label>Publications (if any). Enter details of you publications.
                                (Link can also be added here) (Upto 200 characters)</label>
                                <textarea id="proj2Publ" name="proj2Publ" rows="4" cols="50" >{{old('proj2Publ') }}</textarea>
                            </div>                           
                        </div>
                        <div class="devider-row">                            
                               <label><br><br>List upto three skills acquired during project and rate yourself as described below<br>
                                    Rookie - Have basic theoretical knowledge | Have completed MOOC Course related to skill<br>
                                    Novice - Have completed Lab Experiments or multiple Minor Projects related to skill | Possess good conceptual understanding of subject<br>
                                    Master - Have completed Major Projects | Have spent significant time developing skill (more than 6 months)<br>
                                    Pro - Multiple Projects completed. Put dedicated long term effort on this skill )</label>

                        </div>
                        <div class="devider-row">
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Skills acquired </label>
                                    <select class="form-control" id="skills1_2" name="skills1_2" >
                                    <option hidden>Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{old('skills1_2') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-field">
                                    <label>Skills acquired </label>
                                    <select class="form-control" id="skills2_2" name="skills2_2" >
                                    <option hidden>Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{old('skills2_2') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-field">
                                    <label>Skills acquired </label>
                                    <select class="form-control" id="skills3_2" name="skills3_2" >
                                    <option hidden>Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{old('skills3_2') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Rating for skill1</label>
                                    <select class="form-control" name="rating1_2" id= "rating1_2" >
                                        <option hidden>Select</option>
                                        <option value="Rookie" {{old('rating1_2') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                        <option value="Novice" {{old('rating1_2') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                        <option value="Master" {{old('rating1_2') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="Pro" {{old('rating1_2') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>                                
                                <div class="form-field">
                                    <label>Rating for skill2</label>
                                    <select class="form-control" name="rating2_2" id= "rating2_2" >
                                        <option hidden>Select</option>
                                        <option value="Rookie" {{old('rating2_2') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                        <option value="Novice" {{old('rating2_2') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                        <option value="Master" {{old('rating2_2') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="Pro" {{old('rating2_2') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>                                
                                <div class="form-field">
                                    <label>Rating for skill3</label>
                                    <select class="form-control" name="rating3_2" id= "rating3_2" >
                                        <option hidden>Select</option>
                                        <option value="Rookie" {{old('rating3_2') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                        <option value="Novice" {{old('rating3_2') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                        <option value="Master" {{old('rating3_2') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="Pro" {{old('rating3_2') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>                            
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <!-- project 3 -->
                    <div class="tab-part">
                        <h4>Project 3</h4>
                        <hr>
                        <div class="devider-row">
                            <div class="form-field">
                                <label>Project title </label>
                                <input type="text" id= "projectTitle3" name="projectTitle3" value="{{old('projectTitle3')}}">
                            </div>
                            <div class="form-field">
                                <label>Brief description (upto 600 characters)</label>
                                <textarea id= "projDesc3" name="projDesc3" rows="6" cols="50">{{old('projDesc3') }}</textarea>
                            </div>                            
                        </div>
                        <div class="devider-row">
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Time duration (in months)</label>
                                    <input type="number" id= "projDuration3" name="projDuration3" value="{{old('projDuration3')}}">
                                </div>
                            </div>
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Number of team members</label>
                                    <input type="number" id= "projMembers3" name="projMembers3" value="{{old('projMembers3')}}">
                                </div>
                            </div>                      
                        </div>
                        <div class="devider-row">
                            <div class="form-field">
                                <label>Your role in the project (upto 200 characters)</label>
                                <textarea id= "projectRole3" name="projectRole3">{{old('projectRole3') }}</textarea>
                            </div>
                            <div class="form-field">
                                <label>Github reporsitory of the project (if available)</label>
                                <input type="text" id= "projGithub3" name="projGithub3" value="{{old('projGithub3')}}" onchange="isUrlValid3(this);">
                            </div> 
                            <div class="form-field">
                                <label>Publications (if any). Enter details of you publications.
                                (Link can also be added here) (Upto 200 characters)</label>
                                <textarea id="proj3Publ" name="proj3Publ" rows="4" cols="50" >{{old('proj3Publ') }}</textarea>
                            </div>                           
                        </div>
                        <div class="devider-row">                            
                               <label><br><br>List upto three skills acquired during project and rate yourself as described below<br>
                                    Rookie - Have basic theoretical knowledge | Have completed MOOC Course related to skill<br>
                                    Novice - Have completed Lab Experiments or multiple Minor Projects related to skill | Possess good conceptual understanding of subject<br>
                                    Master - Have completed Major Projects | Have spent significant time developing skill (more than 6 months)<br>
                                    Pro - Multiple Projects completed. Put dedicated long term effort on this skill )</label>
                        </div>
                        <div class="devider-row">
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Skills acquired </label>
                                    <select class="form-control" id="skills1_3" name="skills1_3" >
                                    <option hidden>Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{old('skills1_3') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-field">
                                    <label>Skills acquired </label>
                                    <select class="form-control" id="skills2_3" name="skills2_3" >
                                    <option hidden>Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{old('skills2_3') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-field">
                                    <label>Skills acquired </label>
                                    <select class="form-control" id="skills3_3" name="skills3_3" >
                                    <option hidden>Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{old('skills3_3') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Rating for skill1</label>
                                    <select class="form-control" name="rating1_3" id= "rating1_3" >
                                        <option hidden>Select</option>
                                        <option value="Rookie" {{old('rating1_3') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                        <option value="Novice" {{old('rating1_3') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                        <option value="Master" {{old('rating1_3') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="Pro" {{old('rating1_3') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>                                
                                <div class="form-field">
                                    <label>Rating for skill2</label>
                                    <select class="form-control" name="rating2_3" id= "rating2_3" >
                                        <option hidden>Select</option>
                                        <option value="Rookie" {{old('rating2_3') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                        <option value="Novice" {{old('rating2_3') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                        <option value="Master" {{old('rating2_3') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="Pro" {{old('rating2_3') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>                                
                                <div class="form-field">
                                    <label>Rating for skill3 </label>
                                    <select class="form-control" name="rating3_3" id= "rating3_3" >
                                        <option hidden>Select</option>
                                        <option value="Rookie" {{old('rating3_3') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                        <option value="Novice" {{old('rating3_3') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                        <option value="Master" {{old('rating3_3') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="Pro" {{old('rating3_3') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>                            
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <!-- project 4 -->
                    <div class="tab-part">
                        <h4>Project 4</h4>
                        <hr>
                        <div class="devider-row">
                            <div class="form-field">
                                <label>Project title </label>
                                <input type="text" id= "projectTitle4" name="projectTitle4" value="{{old('projectTitle4')}}">
                            </div>
                            <div class="form-field">
                                <label>Brief description  (upto 600 characters)</label>
                                <textarea id= "projDesc4" name="projDesc4" rows="6" cols="50">{{old('projDesc4') }}</textarea>
                            </div>                            
                        </div>

                        <div class="devider-row">
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Time duration (in months) </label>
                                    <input type="number" id= "projDuration4" name="projDuration4" value="{{old('projDuration4')}}">
                                </div>
                            </div>
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Number of team members</label>
                                    <input type="number" id= "projMembers4" name="projMembers4" value="{{old('projMembers4')}}">
                                </div>
                            </div>                      
                        </div>
                        <div class="devider-row">
                            <div class="form-field">
                                <label>Your role in the project  (upto 200 characters)</label>
                                <textarea id= "projectRole4" name="projectRole4">{{old('projectRole4') }}</textarea>
                            </div>
                            <div class="form-field">
                                <label>Github reporsitory of the project (if available)</label>
                                <input type="text" id= "projGithub4" name="projGithub4" value="{{old('projGithub4')}}" onchange="isUrlValid4(this);">
                            </div> 
                            <div class="form-field">
                                <label>Publications (if any). Enter details of you publications.
                                (Link can also be added here) (Upto 200 characters)</label>
                                <textarea id="proj4Publ" name="proj4Publ" rows="4" cols="50" >{{old('proj4Publ') }}</textarea>
                            </div>                           
                        </div>
                        <div class="devider-row">                            
                               <label><br><br>List upto three skills acquired during project and rate yourself as described below<br>
                                    Rookie - Have basic theoretical knowledge | Have completed MOOC Course related to skill<br>
                                    Novice - Have completed Lab Experiments or multiple Minor Projects related to skill | Possess good conceptual understanding of subject<br>
                                    Master - Have completed Major Projects | Have spent significant time developing skill (more than 6 months)<br>
                                    Pro - Multiple Projects completed. Put dedicated long term effort on this skill )</label>
                        </div>
                        <div class="devider-row">
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Skills acquired </label>
                                    <select class="form-control" id="skills1_4" name="skills1_4" >
                                    <option hidden>Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{old('skills1_4') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-field">
                                    <label>Skills acquired </label>
                                    <select class="form-control" id="skills2_4" name="skills2_4" >
                                    <option hidden>Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{old('skills2_4') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-field">
                                    <label>Skills acquired </label>
                                    <select class="form-control" id="skills3_4" name="skills3_4" >
                                    <option hidden>Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{old('skills3_4') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Rating for skill1</label>
                                    <select class="form-control" name="rating1_4" id= "rating1_4" >
                                        <option hidden>Select</option>
                                        <option value="Rookie" {{old('rating1_4') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                        <option value="Novice" {{old('rating1_4') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                        <option value="Master" {{old('rating1_4') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="Pro" {{old('rating1_4') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>                                
                                <div class="form-field">
                                    <label>Rating for skill2</label>
                                    <select class="form-control" name="rating2_4" id= "rating2_4" >
                                        <option hidden>Select</option>
                                        <option value="Rookie" {{old('rating2_4') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                        <option value="Novice" {{old('rating2_4') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                        <option value="Master" {{old('rating2_4') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="Pro" {{old('rating2_4') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>                                
                                <div class="form-field">
                                    <label>Rating for skill3</label>
                                    <select class="form-control" name="rating3_4" id= "rating3_4" >
                                        <option hidden>Select</option>
                                        <option value="Rookie" {{old('rating3_4') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                        <option value="Novice" {{old('rating3_4') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                        <option value="Master" {{old('rating3_4') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="Pro" {{old('rating3_4') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>                            
                            </div>
                        </div>      
                    </div>
                    <!-- project 5 -->
                    <div class="tab-part">
                        <h4>Project 5</h4>
                        <hr>
                        <div class="devider-row">
                            <div class="form-field">
                                <label>Project title </label>
                                <input type="text" id= "projectTitle5" name="projectTitle5" value="{{old('projectTitle5')}}">
                            </div>
                            <div class="form-field">
                                <label>Brief description  (upto 600 characters)</label>
                                <textarea id= "projDesc5" name="projDesc5" rows="6" cols="50">{{old('projDesc5') }}</textarea>
                            </div>                            
                        </div>
                        <div class="devider-row">
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Time duration (in months) *</label>
                                    <input type="number" id= "projDuration5" name="projDuration5" value="{{old('projDuration5')}}">
                                </div>
                            </div>
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Number of team members </label>
                                    <input type="number" id= "projMembers5" name="projMembers5" value="{{old('projMembers5')}}">
                                </div>
                            </div>                      
                        </div>
                        <div class="devider-row">
                            <div class="form-field">
                                <label>Your role in the project (upto 200 characters)</label>
                                <textarea id= "projectRole5" name="projectRole5">{{old('projectRole5') }}</textarea>
                            </div>
                            <div class="form-field">
                                <label>Github reporsitory of the project (if available)</label>
                                <input type="text" id= "projGithub5" name="projGithub5" value="{{old('projGithub5')}}" onchange="isUrlValid5(this);">
                            </div> 
                            <div class="form-field">
                                <label>Publications (if any). Enter details of you publications.
                                (Link can also be added here) (Upto 200 characters)</label>
                                <textarea id="proj5Publ" name="proj5Publ" rows="4" cols="50" >{{old('proj5Publ') }}</textarea>
                            </div>                           
                        </div>
                        <div class="devider-row">                            
                               <label><br><br>List upto three skills acquired during project and rate yourself as described below<br>
                                    Rookie - Have basic theoretical knowledge | Have completed MOOC Course related to skill<br>
                                    Novice - Have completed Lab Experiments or multiple Minor Projects related to skill | Possess good conceptual understanding of subject<br>
                                    Master - Have completed Major Projects | Have spent significant time developing skill (more than 6 months)<br>
                                    Pro - Multiple Projects completed. Put dedicated long term effort on this skill )</label>
                        </div>
                        <div class="devider-row">
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Skills acquired </label>
                                    <select class="form-control" id="skills1_5" name="skills1_5" >
                                    <option hidden>Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{old('skills1_5') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-field">
                                    <label>Skills acquired </label>
                                    <select class="form-control" id="skills2_5" name="skills2_5" >
                                    <option hidden>Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{old('skills2_5') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-field">
                                    <label>Skills acquired </label>
                                    <select class="form-control" id="skills3_5" name="skills3_5" >
                                    <option hidden>Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{old('skills3_5') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="half-2">
                                <div class="form-field">
                                    <label>Rating for skill1</label>
                                    <select class="form-control" name="rating1_5" id= "rating1_5" >
                                        <option hidden>Select</option>
                                        <option value="Rookie" {{old('rating1_5') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                        <option value="Novice" {{old('rating1_5') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                        <option value="Master" {{old('rating1_5') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="Pro" {{old('rating1_5') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>                                
                                <div class="form-field">
                                    <label>Rating for skill2</label>
                                    <select class="form-control" name="rating2_5" id= "rating2_5" >
                                        <option hidden>Select</option>
                                        <option value="Rookie" {{old('rating2_5') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                        <option value="Novice" {{old('rating2_5') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                        <option value="Master" {{old('rating2_5') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="Pro" {{old('rating2_5') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>                                
                                <div class="form-field">
                                    <label>Rating for skill3</label>
                                    <select class="form-control" name="rating3_5" id= "rating3_5" >
                                        <option hidden>Select</option>
                                        <option value="Rookie" {{old('rating3_5') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                        <option value="Novice" {{old('rating3_5') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                        <option value="Master" {{old('rating3_5') == 'Master' ? 'selected' : '' }}>Master</option>
                                        <option value="Pro" {{old('rating3_5') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                </div>                            
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <div class="devider-row">
                        <div class="form-field">
                            <label>Any other publications</label>
                            <textarea id="otherPubl" name="otherPubl" rows="4" cols="50" >{{old('otherPubl') }}</textarea>
                        </div>
                    </div>
                    <div class="devider-row">
                      <div class="next-btn"><a data-toggle="formtab" href="#mooc">Next</a></div>
                    </div>                
                </div>
                    
                <div class="tabs-panels" id="mooc">
                  <div class="tab-part">
                      <h4>MOOC Coursework (If any)</h4>
                      <br>
                      <label>If number of courses undertaken is more than 1, please mention them using comma seperation.</label>
                      <hr>
                      <div class="devider-row">
                          <div class="form-field">
                              <label>Course Specialization Name</label>
                              <input type="text" id="moocCourseName" name="moocCourseName" placeholder="Enter course name" value="{{old('moocCourseName')}}">
                          </div>
                          <div class="form-field">
                              <label>Platform</label>
                              <!-- <input type="text" id="moocPlatform" name="moocPlatform" placeholder="Enter platform" value="{{old('moocPlatform')}}"> -->
                              <select name="moocPlatform" id= "moocPlatform" class="form-control">
                                  <option hidden>Select</option>
                                  <option value="Coursera" {{old('moocPlatform') == 1 ? 'selected' : '' }}>Coursera</option>
                                  <option value="edX" {{old('moocPlatform') == 1 ? 'selected' : '' }}>edX</option>
                                  <option value="e-Yantra MOOC" {{old('moocPlatform') == 1 ? 'selected' : '' }}>e-Yantra MOOC</option>
                                  <option value="NPTEL" {{old('moocPlatform') == 1 ? 'selected' : '' }}>NPTEL</option>
                                  <option value="Swayam" {{old('moocPlatform') == 1 ? 'selected' : '' }}>Swayam</option>
                                  <option value="Diksha" {{old('moocPlatform') == 1 ? 'selected' : '' }}>Diksha</option>
                                  <option value="Udemy" {{old('moocPlatform') == 1 ? 'selected' : '' }}>Udemy</option>
                                  <option value="Others" {{old('moocPlatform') == 1 ? 'selected' : '' }}>Others</option> 
                              </select>
                          </div>
                          <div class="form-field">
                              <label>Upload all Certificate image / Progress (online screenshot) compiled in one PDF.<br> (less than 5MB, formats allowed- PDF Only)</label>
                              <input type="file" name="image" class="form-control" style="width:30%" id="image" />
                              <span id="uploaded_image"></span>
                               <input type="hidden" id="filename" name="filename">
                          </div>
                          <div class="form-field">
                              <label>Number of courses started but not completed</label>
                              <input type="text" id="moocIncomplete" name="moocIncomplete" value="{{old('moocIncomplete')}}">
                          </div>                            
                      </div>
                  </div>
                  <div class="next-btn">
                      <a data-toggle="formtab" href="#eyrceyic">Next</a>
                  </div>                    
                </div>

          <!-- //eyrc details -->
                <div class="tabs-panels" id="eyrceyic">
                    <div class="tab-part">
                      <h4>e-Yantra Affiliations</h4>
                      <hr>
                      <div class="devider-row">
                          <div class="form-field">
                              <label>Please mention your affiliation with e-Yantra? *</label>
                              <div class="radio">                                   
                                  <input type="radio" id="eyrc" name="competition" value="eyrc" {{old('competition') == 'eyrc' ? 'checked' : '' }} onclick="showeyrc();">
                                  <label for="eyrc">eYRC</label>
                              </div>
                              <div class="radio">
                                  <input type="radio" id="eyic" name="competition" value="eyic" {{old('competition') == 'eyic' ? 'checked' : '' }} onclick="hideeyrc();">
                                  <label for="eyic">eYIC</label>
                              </div>
                              <div class="radio">
                                  <input type="radio" id="mooc" name="competition" value="mooc" {{old('competition') == 'mooc' ? 'checked' : '' }} onclick="hideeyrc();">
                                  <label for="mooc">MOOC</label>
                              </div>
                          </div>
                          <br>
                          <div id="showeyrc" class="form-field" style="display: none;">
                              <label for="theme">eYRC Theme *</label>
                              <!-- <input type="text" name="theme" id="theme" placeholder="Enter theme name" value="{{old('theme')}}"> -->
                              <select name="theme" id= "theme" class="form-control">
                                  <option hidden>Select theme</option>
                                  <option value="Vitarana Drone" {{old('theme') == 1 ? 'selected' : '' }}>Vitarana Drone (VD)</option>
                                  <option value="Sahayak Bot" {{old('theme') == 1 ? 'selected' : '' }}>Sahayak Bot (SB)</option>
                                  <option value="Sankatmochan Bot" {{old('theme') == 1 ? 'selected' : '' }}>Sankatmochan Bot (SM)</option>
                                  <option value="Vargi Bot" {{old('theme') == 1 ? 'selected' : '' }}>Vargi Bots (VB)</option>
                                  <option value="Nirikshak Bot" {{old('theme') == 1 ? 'selected' : '' }}>Nirikshak Bots (NB)</option>
                              </select>
                              <br>                                
                              <label>Where is your Theme Kit? *</label>
                              <select name="hardware" id= "hardware" class="form-control">
                                  <option hidden>Select</option>
                                  <option value="1" {{old('hardware') == 1 ? 'selected' : '' }}>With Me</option>
                                  <option value="2" {{old('hardware') == 2 ? 'selected' : '' }}>With other team projMembers5</option>
                                  <option value="3" {{old('hardware') == 3 ? 'selected' : '' }}>Submitted to College</option>
                              </select>
                          </div>
                          <div id="showeyrc" class="form-field">
                              <label for="theme">List of hardware that you have(other than theme kit) for immediate use in eYSIP. (ex. Microcontrollers, Sensors, Actuators, etc)</label>
                              <input type="text" name="otherhw" id="otherhw" placeholder="Enter hardware names" value="{{old('otherhw')}}">
                          </div>
                      </div>
                    </div>
                    <div class="next-btn">
                        <a data-toggle="formtab" href="#expdtls">Next</a>
                    </div>
                </div>
                 <!-- //experience details -->
                <div class="tabs-panels" id="expdtls">
                    <div class="tab-part">
                        <h4>Experience Details</h4>
                        <hr>
                        <div class="devider-row">
                            <div class="form-field"></div>
                            <div class="form-field">
                              <label>Add Experience Description * (300 words)</label>
                              <label>(Co-Curricular/Extra-Curricular activities)</label>
                            </div>
                          <div class="alert alert-danger print-error-msg" style="display:none">
                            <ul></ul>
                          </div>

                          <div class="alert alert-success print-success-msg" style="display:none">
                            <ul></ul>
                          </div>
                          <div class="table-responsive">  
                            <table class="table table-bordered" id="dynamic_field">  
                                <tr>  
                                  <td><textarea name="expdtl[]" placeholder="Enter your experience details" class="form-control name_list" rows="5" cols="50" id="expdtl" onchange="checkWordLen(this);">{{ old('name.0') }}</textarea></td>  
                                  <td align="center">
                                  <label id="number" name="number"></label>
                                  <button type="button" name="add" id="add" class="btn btn-success" value="1">Add More</button></td>  
                                  <input type="hidden" name="add" id="expcount"/>
                                </tr>                                    
                            </table>                                
                          </div>
                        </div>
                    </div>
                    <div class="next-btn">
                        <a data-toggle="formtab" href="#generalques">Next</a>
                    </div>
                </div>
                <!-- //psycology details -->
                 <div class="tabs-panels" id="generalques">
                    <div class="tab-part">
                        <h4>General Questions</h4>
                        <hr>
                    <div class="devider-row">
                        <div class="form-field">
                           <label>1. Why should I be selected for this internship? (300 words) *</label>
                           <textarea id="whyselect" name="whyselect" rows="4" cols="50" 
                            onchange="checkWordLen(this);">{{old('whyselect') }}</textarea>
                            <br>
                           <label>2. What are your expectations from this remote internship? (50 words) *
                            </label>
                           <textarea id="expectations" name="expectations" rows="4" cols="50">                          {{old('expectations') }}</textarea>
                            <br>
                           <label>3. What are your thoughts on remote internships? (50 words) *</label>
                           <textarea id="thoughts" name="thoughts" rows="4" cols="50">{{old('thoughts') }}
                            </textarea>
                            <label>4. Have you applied for an internship anywhere else? (Enter only if, yes).</label>
                            <input type="text" id="applyintern" name="applyintern" value="{{old('applyintern')}}">
                            <br>
                           <label>5. How will you troubleshoot any problem while working remotely? *
                            (300 words)</label>
                           <textarea id="troubleshoot" name=troubleshoot rows="4" cols="50" 
                            onchange="checkWordLen(this);">{{old('troubleshoot') }}</textarea>
                          <br>
                            <label>6. How do you work best *</label>
                            <div class="radio">                                   
                                <input type="radio" id="Individually" name="workbest" value="Individually" {{old('workbest') == 'Individually' ? 'checked' : '' }}>
                                <label for="Individually">Individually</label>
                            </div>
                            <div class="radio">
                                <input type="radio" id="team" name="workbest" value="Team" {{old('workbest') == 'Team' ? 'checked' : '' }}>
                                <label for="team">Team</label>
                            </div>
                             <div class="radio">
                                <input type="radio" id="both" name="workbest" value="Both"  {{old('workbest') == 'Both' ? 'checked' : '' }}>
                                <label for="both">Both</label>
                            </div>
                        </div>
                    </div>
                    <br><br>
                   <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
        <div class="form-footer"></div>
    </div>

</div>
</div>
</form>

@else
<div class="row">
  <div class="col-md-8 col-md-offset-2" style ="padding-top: 70px; padding-bottom: 70px;">
    <div class="card-body">
      <center>
        <h4 class="card-title"><b>You have successfully submitted your profile.<br> 
        <!-- You can now proceed with the project preferences.</b> </h4>
     
      <a href="/project" class="btn btn-success">View Projects</a> -->
      <a href="/home" class="btn btn-success">Back</a>
       </center>
    </div>
  </div>
</div>
@endif
</div>
</div>
</div>
</body>
</html>

    <hr class="soften"/>
            <footer class="footer col-md-8 col-md-offset-2">
                <p>
                    <span class="pull-right">
                        <a class="btn btn-primary" href="https://twitter.com/eyantra_iitb" target="_blank">t</a>
                        <a class="btn btn-danger" href="https://plus.google.com/u/0/115192232830737300162/posts" target="_blank">g+</a>
                        <a class="btn btn-primary" href="https://www.facebook.com/eyantra" target="_blankk">f</a>
                    </span>

                    {{-- <a href="{!! route('home') !!}">Home</a> --}}
                    <!-- <a href="http://portal.e-yantra.org/eyrc/about_eyrc">About Competition</a> -->
                </p>
                
                <p>&copy; Copyright e-Yantra <br/><br/></p>
                <p class="text-warning">This portal is best viewed in Mozilla Firefox® 10.x or higher, Google Chrome 18 or higher.</p>
            </footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-145861739-9"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-145861739-9');
    </script>

<script type="text/javascript">
//word len
var wordLen = 300; // Maximum word length
     function checkWordLen(obj){
      var len = obj.value.split(/[\s]+/);
       if(len.length > wordLen){
           alert("You cannot put more than "+wordLen+" words in this text area.");
           obj.oldValue = obj.value!=obj.oldValue?obj.value:obj.oldValue;
           obj.value = obj.oldValue?obj.oldValue:"";
           return false;
       }
     return true;
   }

    $('a[data-toggle="formtab"]').click(function(){
    var targetId = $(this).attr('href');

    $('.tabs-panels').removeClass('active')
    $('a[data-toggle="formtab"]').removeClass('active');
    
    $(targetId).addClass('active');
    $('a[href="'+targetId+'"]').addClass('active')
});

function incrementValue()
{
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
}

    // function isUrlValid(url)
    // {
    //     var url = $('#github').val();  
    //     if(url.includes('github'))
    //     {
    //     }
    //     else{ 
    //           alert('Invalid github URL');
    //     }
    // }
    
    
    function isUrlValid1(url)
    {    var url = $('#projGithub1').val();  
        console.log(this);
       if(url.includes("www") || url.includes('http') || url.includes('github')){}
        else{   alert('Invalid github URL');   } }

    function isUrlValid2(url)
    {    var url = $('#projGithub2').val();  
        console.log(this);
       if(url.includes("www") || url.includes('http') || url.includes('github')){}
        else{   alert('Invalid github URL');   } }

    function isUrlValid3(url)
    {    var url = $('#projGithub3').val();  
        console.log(this);
       if(url.includes("www") || url.includes('http') || url.includes('github')){}
        else{   alert('Invalid github URL');   } }
            
    function isUrlValid4(url)
    {    var url = $('#projGithub4').val();  
        console.log(this);
       if(url.includes("www") || url.includes('http') || url.includes('github')){}
        else{   alert('Invalid github URL');   } }
            
    function isUrlValid5(url)
    {    var url = $('#projGithub5').val();  
        console.log(this);
       if(url.includes("www") || url.includes('http') || url.includes('github')){}
        else{   alert('Invalid github URL');   } }

function hideeyrc(){
  document.getElementById('showeyrc').style.display ='none';
   $("#theme").prop("required", false);
  $("#hardware").prop("required", false);
}
function showeyrc(){
  document.getElementById('showeyrc').style.display = 'block';
  $("#theme").prop("required", true);
  $("#hardware").prop("required", true);
}

// ------------------------------------------------------------------------------
 $(document).ready(function(){     


      var postURL = "<?php echo url('addmore'); ?>";
      var k=1;  
      var start = document.getElementById("add");

      $('#add').click(function(){  
           k++;  
         incrementValue();
           $('#dynamic_field').append('<tr id="row'+k+'" class="dynamic-added"><td><textarea name="expdtl[]" placeholder="Enter your experience" rows="5" cols="63"></textarea></td><td align="center"><button type="button" name="remove" id="'+k+'" class="btn btn-danger btn_remove">Remove</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      $(document).on('change', '#image', function (){
        var property = document.getElementById("image").files[0];        
        var image_name = property.name;
        // alert(image_name);
        var image_extension = image_name.split('.').pop().toLowerCase();
        var fullname = document.getElementById("fullname").value;
        console.log(fullname);
        if(jQuery.inArray(image_extension, ['pdf']) == -1)
        {
            alert("Invalid PDF File");
            $('#uploaded_image').html("<label class='text-success'></label>");
        }

        else 
        {
            var image_size = property.size;
            if(image_size > 5242880)
            {
                alert("PDF size should be less than 5MB");
                $('#uploaded_image').html("<label></label>");
            }
            else
            {
              // alert(10);
                document.getElementById("filename").value = image_extension;
                var form_data = new FormData();
                form_data.append("image", property);
                form_data.append("fullname", fullname);
                
                $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    url: "/attachmentUpload",
                    method: "POST",
                    data: form_data,
                    dataType: 'json', 
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function (){
                        $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
                    },              
                }).done(function (data){
                      $('#uploaded_image').html("<label class='text-success'>Uploaded successfully </label>");
                   
                }).fail(function (xhr,status,error){
                    alert('Image could not be uploaded. Try again later.');
                });            
            }
        }
    });  

      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }
    });  

</script>


