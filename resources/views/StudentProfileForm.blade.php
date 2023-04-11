@extends('layouts.app', ['activePage' => 'StudentProfileForm', 'titlePage' => __('Student Profile Form')])

@section('content') 
  <div class="content">
    <div class="container-fluid">
      <div class="col-md-12">
          @if($errors->any())
          <div class="alert alert-danger" role='alert'>
          @foreach($errors->all() as $error)
            <p>{!!$error!!}</p>
          @endforeach
          </div>
          <hr/>
          @endif

        

         @if (session('status'))
          <div class="row">
            <div class="col-sm-12">
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <i class="material-icons">close</i>
                </button>
                <span>{{ session('status') }}</span>
              </div>
            </div>
          </div>
        @endif

          <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title"><b>{{ __('e-Yantra Summer Internship Program') }}</b></h4>
                <p>Fill your complete profile for further assessment </p>
                <p><b>The data on the tabs 1, 2, 4 and 5 is mandatory to be filled. <br>
                Please go to the <b style="color:black;">"Final Confirmation"</b>  tab when all the data is submitted successfully and Click on "I Confirm" Checkbox. Only then, your profile will be considered as complete and submitted.</b></p>
            </div>

            <div class="row">
              <div class="row">
                <ul class="tabs">
                @if($data_exsits == null)
                    <li class="tab waves-effect waves-light btn"><a class="active" href="#test1" style="color: Red">Academic Details<br> <b>(1)*</b></a></li>
                    <li class="tab waves-effect waves-light btn"><a href="#test2" style="color: Red">Project Info<br><b>(2)*</b></a></li>
                    <li class="tab waves-effect waves-light btn"><a href="#test3" style="color: Red">Mooc Courses<br><b>(3)</b></a></li>
                    <li class="tab waves-effect waves-light btn"><a href="#test4" style="color: Red">Experience Details<br><b>(4)*</b></a></li>
                    <li class="tab waves-effect waves-light btn"><a  href="#test5" style="color: Red">e-Yantra Affiliations<br><b>(5)*</b></a></li>
                    <li class="tab waves-effect waves-light btn"><a  href="#test6"><b>Final <br>Confirmation</b></a></li>

                @else

                    @if($data_exsits->tab1count == 0)
                      <li class="tab waves-effect waves-light btn"><a class="active" href="#test1" style="color: Red">Academic Details<br> <b>(1)*</b></a></li>
                    @else
                      <li class="tab waves-effect waves-light btn"><a class="active" href="#test1" style="color: Green">Academic Details<br> <b>(1)*</b></a></li>
                    @endif
                    @if($data_exsits->tab2count == 0)
                      <li class="tab waves-effect waves-light btn"><a href="#test2" style="color: Red">Project Info<br><b>(2)*</b></a></li>
                    @else
                      <li class="tab waves-effect waves-light btn"><a class="active" href="#test2" style="color: Green">Project Info<br> <b>(2)*</b></a></li>
                    @endif
                    @if($data_exsits->tab3count == 0)
                      <li class="tab waves-effect waves-light btn"><a href="#test3" style="color: Red">Mooc Courses<br><b>(3)</b></a></li>
                    @else
                      <li class="tab waves-effect waves-light btn"><a href="#test3" style="color: Green">Mooc Courses<br><b>(3)</b></a></li>
                    @endif
                    @if($data_exsits->tab4count == 0)
                      <li class="tab waves-effect waves-light btn"><a href="#test4" style="color: Red">Experience Details<br><b>(4)*</b></a></li>
                    @else
                      <li class="tab waves-effect waves-light btn"><a href="#test4" style="color: Green">Experience Details<br><b>(4)*</b></a></li>
                    @endif

                    @if($data_exsits->tab5count == 0)
                      <li class="tab waves-effect waves-light btn"><a  href="#test5" style="color: Red">e-Yantra Affiliations<br><b>(5)*</b></a></li>
                    @else
                      <li class="tab waves-effect waves-light btn"><a  href="#test5" style="color: Green">e-Yantra Affiliations<br><b>(5)*</b></a></li>
                    @endif
                    <li class="tab waves-effect waves-light btn"><a  href="#test6"><b>Final <br>Confirmation</b></a></li>
                  @endif
                </ul>
              

                <div class="card-body">
                  <div id="test1" class="col s12">
                    <p class="ml-4 px-4" style="color:red;">All fields are mandatory</p>
                    <form method="post" action="{{ route('submitSection1') }}" autocomplete="off" 
                      class="form-horizontal">
                      @csrf
                      <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold;">{{ __('Name') }}<span style="color:red;">*</span></label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('fullname') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="fullname" id="fullname" placeholder="Name" value="{{ old('fullname', auth()->user()->name) }}" required>
                            @if ($errors->has('fullname'))
                              <span id="fullname-error" class="error text-danger" for="fullname">{{ $errors->first('fullname') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Email Id') }}<span style="color:red;">*</span></label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('email') ? ' has-danger' : '' }}">
                            <input class="form-control" name="email" id="email" placeholder="Email Id Email Id" value="{{ old('fullname', auth()->user()->email) }}" rows="4" wrap="physical" required readonly="true">
                            @if ($errors->has('email'))
                              <span id="email-error" class="error text-danger" for="email">{{ $errors->first('email') }}</span>
                            @endif
                          </div>
                        </div>
                        
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Contact No') }}<span style="color:red;">*</span></label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="phone" id="phone" placeholder="Contact No" value="{{old('phone', $data_exsits->phone)}}" required>
                            @if ($errors->has('phone'))
                              <span id="phone-error" class="error text-danger" for="phone">{{ $errors->first('phone') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('College') }}<span style="color:red;">*</span></label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('college') ? ' has-danger' : '' }}">
                            <select class="form-control" id="college" name="college" 
                                    value="{{old('college')}}" required>
                                  <option hidden value="">Select your college</option>
                                @foreach($colleges as $college)
                                  @if( old('college', $data_exsits->clg_code) == $college->clg_code )
                                    <option  value="{{$college->clg_code}}" selected="true">
                                        {{$college->college_name}}
                                    </option>
                                  @else
                                    <option  value="{{$college->clg_code}}">{{ $college->college_name }}</option>
                                  @endif                                
                                @endforeach
                            </select>
                            @if ($errors->has('college'))
                              <span id="college-error" class="error text-danger" for="college">{{ $errors->first('college') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Select Year') }}<span style="color:red;">*</span></label>
                        <div class="col-sm-3">
                          <select id="year" class="form-control" name="year" required>
                            <option hidden value="">Select year</option>
                            <option value="1" {{old('year', $data_exsits->year) == 1 ? 'selected': '' }}>
                              First year
                            </option>
                            <option value="2" {{old('year',$data_exsits->year) == 2 ? 'selected': '' }}>
                              Second year
                            </option>
                            <option value="3" {{old('year',$data_exsits->year) == 3 ? 'selected': '' }}>
                              Third year
                            </option>
                            <option value="4" {{old('year',$data_exsits->year) == 4 ? 'selected': '' }}>
                              Fourth year
                            </option>
                          </select>
                        </div>
                      
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Select Department') }}<span style="color:red;">*</span></label>
                        <div class="col-sm-3">
                          <select class="form-control" id="department" name="department" value="{{old('department')}}" required>
                            <option hidden value="">Select department</option>
                                @foreach($departments as $department)
                                <option value="{{$department->id}}" {{old('department', $data_exsits->branch) == $department->name ? 'selected' : ''  }}>{{$department->name}}</option>
                                @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Present GPA/ Percentage') }}<span style="color:red;">*</span></label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('gpa') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="gpa" id="gpa" placeholder="gpa" value="{{old('gpa', $data_exsits->gpa)}}" required>
                            @if ($errors->has('gpa'))
                              <span id="gpa-error" class="error text-danger" for="gpa">{{ $errors->first('gpa') }}</span>
                            @endif
                          </div>
                        </div>

                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Class 12 or diploma Percentage') }}<span style="color:red;">*</span></label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('class12') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="class12" id="class12" placeholder="class12" value="{{old('class12', $data_exsits->class12)}}" required>
                            @if ($errors->has('class12'))
                              <span id="class12-error" class="error text-danger" for="class12">{{ $errors->first('class12') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Class 12 Board') }}<span style="color:red;">*</span></label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('class12board') ? ' has-danger' : '' }}">
                          <select id="class12board" class="form-control" name="class12board" value="{{old('class12board')}}" required>
                                  <option hidden value="">Select</option>
                                  <option value="HSC" {{ old('class12board', $data_exsits->class12board ) == "HSC" ? 'selected': '' }}>HSC</option>
                                  <option value="CBSE" {{ old('class12board', $data_exsits->class12board) == "CBSE" ? 'selected': '' }}>CBSE</option>
                                  <option value="ICSE" {{ old('class12board', $data_exsits->class12board) == "ICSE" ? 'selected': '' }}>ICSE/ISC</option>
                                  <option value="IGCSE" {{ old('class12board', $data_exsits->class12board) == "IGCSE" ? 'selected': '' }}>IGCSE</option>
                                  <option value="IB" {{ old('class12board', $data_exsits->class12board) == "IB" ? 'selected': '' }}>IB</option>
                                  <option value="Diploma" {{ old('class12board', $data_exsits->class12board) == "Diploma" ? 'selected': '' }}>Diploma</option>
                              </select>
                            @if ($errors->has('class12board'))
                              <span id="class12board-error" class="error text-danger" for="class12board">{{ $errors->first('class12board') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Github Link') }}<span style="color:red;">*</span></label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('github') ? ' has-danger' : '' }}">
                            <input type = "url" class="form-control" name="github" id="github" placeholder="Github link" value="{{old('github', $data_exsits->github)}}"github rows="4" wrap="physical" required>
                            @if ($errors->has('github'))
                              <span id="github-error" class="error text-danger" for="github">{{ $errors->first('github') }}</span>
                            @endif
                          </div>
                        </div>

                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Linked In') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('linkedin') ? ' has-danger' : '' }}">
                            <input type = "url" class="form-control" type="text" name="linkedin" id="linkedin" placeholder="LinkedIn ID" value="{{old('linkedin', $data_exsits->linkedin)}}" required>
                            @if ($errors->has('linkedin'))
                              <span id="linkedin-error" class="error text-danger" for="linkedin">{{ $errors->first('linkedin') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Instagram') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('insta') ? ' has-danger' : '' }}">
                            <input class="form-control" name="insta" id="insta" placeholder="Instagram ID" value="{{old('insta', $data_exsits->instagram)}}" rows="4" wrap="physical">
                            @if ($errors->has('insta'))
                              <span id="insta-error" class="error text-danger" for="insta">{{ $errors->first('insta') }}</span>
                            @endif
                          </div>
                        </div>

                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Facebook') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('fb') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="fb" id="fb" placeholder="Facebook ID" value="{{old('fb', $data_exsits->facebook)}}">
                            @if ($errors->has('fb'))
                              <span id="fb-error" class="error text-danger" for="fb">{{ $errors->first('fb') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>

                      <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>
                      </div>
                    </form>
                  </div>
                  <div id="test2" class="col s12">
                    <form method="post" action="{{ route('submitSection2') }}" autocomplete="off" 
                      class="form-horizontal">
                      @csrf
                      <div class="row parent-div">
                        <div class="col-md-12" id="copy-this-div">
                          <div class="row">
                            <label class="col-sm-3 col-form-label"style = "color:black;font-weight: bold">{{ __('Project Title') }}<span style="color:red;">*</span></label>
                            <div class="col-sm-6">
                              <input class="form-control" type="text" name="projectTitle[]" id="projectTitle" placeholder="Project Title" value="{{ old('projectTitle')}}" required>
                            </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">{{ __('Project Description') }}<span style="color:red;">*</span></label>
                            <div class="col-sm-6">
                              <input class="form-control" name="projDesc[]" id="projDesc" placeholder="Project Desciption" value="{{ old('projDesc') }}" rows="4" wrap="physical" required>
                            </div>
                          </div>

                          <div class="row">
                            <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">{{ __('Project Duration') }}<span style="color:red;">*</span></label>
                              <div class="col-sm-6">
                                <input type="number" class="form-control" placeholder="Project Duration(In months)" name="projDuration[]" id="projDuration" value="{{old('projDuration')}}" required>
                              </div>
                          </div>  
                          <div class="row">  
                            <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">{{ __('No of Team Members') }}<span style="color:red;">*</span></label>
                              <div class="col-sm-6">
                                <input type="number" class="form-control" name="projMembers[]" id="projMembers" placeholder="No of Team Members" value="{{old('projMembers')}}" required>
                              </div>
                          </div>
                          <div class="row">
                              <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">Your role in the project<span style="color:red;">*</span></label>
                              <div class="col-sm-6">
                                <textarea id= "projectRole" class="form-control" name="projectRole[]" maxlength="250" placeholder="Short Description of your role upto 250 characters" rows="2" required>{{old('projectRole') }}</textarea>
                              </div>
                          </div>
                          <div class="row">
                              <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">Github repo of the project (if any)</label>
                              <div class="col-sm-6">
                                <input type="text" id= "projGithub" class="form-control" name="projGithub[]" value="{{old('projGithub')}}">
                              </div>
                          </div>
                          <div class="row">
                              <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">Publications (if any)</label>
                              <div class="col-sm-6">
                                <textarea id="projPubl" name="projPubl[]" class="form-control" rows="4" cols="50" placeholder="Publications Link can also be added here, max upto 200 characters">{{old('projPubl') }}</textarea>
                              </div>
                          </div>  
                          <div class="row">
                              <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">{{ __('Skills Acquired') }}<span style="color:red;">*</span></label>
                                <div class="col">
                                  <select class="form-control" id="skills1" name="skills1[]" >
                                    <option hidden value="null">Select Skills</option>
                                      @foreach($skills as $skill)
                                      <option value="{{$skill->id}}"  {{old('skills1') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                      @endforeach
                                  </select>
                                </div>
                              <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">{{ __('Rating for skill1') }}<span style="color:red;">*</span></label>
                                <div class="col">
                                  <select class="form-control" name="rating1[]" id= "rating1" >
                                    <option hidden>Select</option>
                                    <option value="Rookie" {{old('rating1') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                    <option value="Novice" {{old('rating1') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                    <option value="Master" {{old('rating1') == 'Master' ? 'selected' : '' }}>Master</option>
                                    <option value="Pro" {{old('rating1') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                  </select>
                                </div>
                          </div>

                          <div class="row">
                              <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">{{ __('Skills Acquired') }}<span style="color:red;">*</span></label>
                                <div class="col">
                                  <select class="form-control" id="skills2" name="skills2[]" >
                                    <option hidden value="null">Select Skills</option>
                                      @foreach($skills as $skill)
                                      <option value="{{$skill->id}}"  {{old('skills2') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                      @endforeach
                                  </select>
                                </div>
                              <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">{{ __('Rating for skill2') }}<span style="color:red;">*</span></label>
                                <div class="col">
                                  <select class="form-control" name="rating2[]" id= "rating2" >
                                    <option hidden>Select</option>
                                    <option value="Rookie" {{old('rating2') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                    <option value="Novice" {{old('rating2') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                    <option value="Master" {{old('rating2') == 'Master' ? 'selected' : '' }}>Master</option>
                                    <option value="Pro" {{old('rating2') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                  </select>
                                </div>
                          </div>

                          <div class="row">
                              <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">{{ __('Skills Acquired') }}<span style="color:red;">*</span></label>
                                <div class="col">
                                  <select class="form-control" id="skills3" name="skills3[]" >
                                    <option hidden value="null">Select Skills</option>
                                      @foreach($skills as $skill)
                                      <option value="{{$skill->id}}"  {{old('skills3') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                      @endforeach
                                  </select>
                                </div>
                              <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">{{ __('Rating for skill3') }}<span style="color:red;">*</span></label>
                                <div class="col">
                                  <select class="form-control" name="rating3[]" id= "rating3" >
                                    <option hidden>Select</option>
                                    <option value="Rookie" {{old('rating3') == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                    <option value="Novice" {{old('rating3') == 'Novice' ? 'selected' : '' }}>Novice</option>
                                    <option value="Master" {{old('rating3') == 'Master' ? 'selected' : '' }}>Master</option>
                                    <option value="Pro" {{old('rating3') == 'Pro' ? 'selected' : '' }}>Pro</option>
                                  </select>
                                </div>
                          </div>

                          <hr style="background-color: Red">
                          <br>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <button type="button" id="add_project" class="btn btn-success add-btn">Add More Projects</button>
                      </div>

                      <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>
                      </div>
                    </form>
                  </div>
                  <div id="test3" class="col s12">
                    <form method="post" action="{{ route('submitSection3') }}" autocomplete="off" 
                      class="form-horizontal">
                      @csrf
                      <h5 style = "font-weight: bold; padding-left:3%;">MOOC Coursework (If any)</h5>
                      <label style = "color:red; padding-left:2%;">If number of courses undertaken is more than 1, please mention them using comma seperation.</label>

                      <div class="row">
                        <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">{{ __('Mooc Course Name') }}</label>
                        <div class="col-sm-6">
                          <div class="input-field">
                            <input class="form-control" type="text" name="moocCourseName" id="moocCourseName" placeholder="Mooc Course Name" value="{{ old('moocCourseName', $data_exsits->mooc_course) }}">
                          </div>
                        </div>
                      </div><br>
                      <div class="row">
                        <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">{{ __('Platform') }}</label>
                        <div class="col-sm-8">
                          <input type="checkbox" name="moocPlatform[]" value="Coursera" {{(is_array( old('moocPlatform')) && in_array('Coursera', old('moocPlatform'))) || in_array('Coursera', explode(',' , $data_exsits->platform)) ? 'checked' : '' }}> &nbsp; Coursera  &nbsp; &nbsp;
                          <input type="checkbox" name="moocPlatform[]" value="edX" {{(is_array( old('moocPlatform')) && in_array('edX', old('moocPlatform'))) || in_array('edX', explode(',' , $data_exsits->platform)) ? 'checked' : '' }}> &nbsp; edX &nbsp; &nbsp; 
                          <input type="checkbox" name="moocPlatform[]" value="e-Yantra MOOC" {{(is_array( old('moocPlatform')) && in_array('e-Yantra MOOC', old('moocPlatform'))) || in_array('e-Yantra MOOC', explode(',' , $data_exsits->platform)) ? 'checked' : '' }}>&nbsp; e-Yantra MOOC &nbsp; &nbsp; 
                          <input type="checkbox" name="moocPlatform[]" value="NPTEL" {{(is_array( old('moocPlatform')) && in_array('NPTEL', old('moocPlatform'))) || in_array('NPTEL', explode(',' , $data_exsits->platform)) ? 'checked' : '' }}>&nbsp; NPTEL &nbsp; &nbsp; 
                          <input type="checkbox" name="moocPlatform[]" value="Swayam" {{(is_array( old('moocPlatform')) && in_array('Swayam', old('moocPlatform'))) || in_array('Swayam', explode(',' , $data_exsits->platform)) ? 'checked' : '' }}>&nbsp; Swayam &nbsp;  &nbsp; 
                          <input type="checkbox" name="moocPlatform[]" value="Diksha" {{(is_array( old('moocPlatform')) && in_array('Diksha', old('moocPlatform'))) || in_array('Diksha', explode(',' , $data_exsits->platform)) ? 'checked' : '' }}>&nbsp; Diksha &nbsp; &nbsp; 
                          <input type="checkbox" name="moocPlatform[]" value="Udemy" {{(is_array( old('moocPlatform')) && in_array('Udemy', old('moocPlatform'))) || in_array('Udemy', explode(',' , $data_exsits->platform)) ? 'checked' : '' }}>&nbsp; Udemy &nbsp; &nbsp; 
                          <input type="checkbox" name="moocPlatform[]" value="Other" {{(is_array( old('moocPlatform')) && in_array('Other', old('moocPlatform'))) || in_array('Other', explode(',' , $data_exsits->platform)) ? 'checked' : '' }} onclick="ShowHideDiv1(this)">&nbsp; Other &nbsp; &nbsp; 
                          <div id="dvtopics" style="display:none">Other Topics
                            <input type="text" class="form-control" id="txttopics" name="othertopic" />
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">{{ __('No. of incompleted courses') }}</label>
                        <div class="col-sm-6">
                          <input class="form-control" type="text" name="moocIncomplete" id="moocIncomplete" placeholder="Mooc course started but not complete" value="{{ old('moocIncomplete', $data_exsits->   number_of_courses_incomplete) }}">
                        </div>
                      </div>
                      <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>
                      </div>
                    </form>
                  </div>
                  <div id="test4" class="col s12">
                    <form method="post" action="{{ route('submitSection4') }}" autocomplete="off" 
                        class="form-horizontal">
                        @csrf
                      <div id="expdtls">
                          <h5 style = "font-weight: bold; padding-left:3%;">Experience Details (Adding atleast 1 experience is mandatory)</h5>
                          <!-- <label class="col-sm-9 col-form-label">{{ __('Add Experience Description- (600 characters) (Co-Curricular/Extra-Curricular activities)') }}</label> -->
                          <div class="col-lg-12" id="expdtls"> 
                            <table class="table" id="dynamic_field">  
                              <tr>  
                                <td><textarea name="expdtl[]" placeholder="Add Experience Description- (600 characters) (Co-Curricular/Extra-Curricular activities)" class="form-control name_list" rows="5" cols="50" id="expdtl" maxlength="600" required>{{ old('name.0') }}</textarea></td>  
                                <td align="center">
                                <label id="number" name="number"></label>
                                <button type="button" name="add" id="add" class="btn btn-success" value="1" onclick="addmore()">Add More</button></td>  
                                <input type="hidden" name="add" id="expcount"/>
                              </tr>                                    
                            </table>                                
                          </div>
                      </div>
                      <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>
                      </div>
                    </form>
                  </div>
                  <div id="test5" class="col s12">
                    <form method="post" action="{{ route('submitSection5') }}" autocomplete="off" 
                      class="form-horizontal">
                      @csrf
                      <div class="row">
                        <label class="col-sm-6 col-form-label" style = "color:black;font-weight: bold">{{ __('Please mention your affiliation with e-Yantra') }}</label>
                        <div class="col-sm-6" style="margin-left:3%">
                          <div>                                   
                            <input type="radio" id="eyrc" name="competition" value="eyrc" {{old('competition') == 'eyrc' ? 'checked' : '' }} onclick="showeyrc();" required>
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
                          <div class="radio">
                            <input type="radio" id="hackathon" name="competition" value="hackathon" {{old('competition') == 'hackathon' ? 'checked' : '' }} onclick="hideeyrc();">
                                  <label for="mooc">Hackathon</label>
                          </div>
                          <div class="radio">
                            <input type="radio" id="design" name="competition" value="design" {{old('competition') == 'design' ? 'checked' : '' }} onclick="hideeyrc();">
                            <label for="mooc">Design Sprint</label>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div id="showeyrc" style="display: none;">
                        <div calss="row">
                          <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">{{ __('eYRC Theme') }}</label>
                          <div class="col-lg-2">
                            <select name="theme" id="theme" class="form-control">
                              <option hidden>Select theme</option>
                              <option value="FB" {{old('theme') == 1 ? 'selected' : '' }}>Functional RoadBot (FB)</option>
                              <option value="KB" {{old('theme') == 1 ? 'selected' : '' }}>Krishi Bot (KB)</option>
                              <option value="PB" {{old('theme') == 1 ? 'selected' : '' }}>Pharma Bot (PB)</option>
                              <option value="SB" {{old('theme') == 1 ? 'selected' : '' }}>Swatchhta Bot (SB)</option>
                              <option value="DB" {{old('theme') == 1 ? 'selected' : '' }}>Delivery Bike (DB)</option>
                              <option value="SD" {{old('theme') == 1 ? 'selected' : '' }}>Sentinel Drone (SD)</option>
                              <option value="HB" {{old('theme') == 1 ? 'selected' : '' }}>HolA Bot (HB)</option>
                            </select>
                          </div>
                          <label class="col-sm-3 col-form-label" style = "color:black;font-weight: bold">{{ __('Where is your Theme Kit?') }}</label>
                          <div class="col-lg-2">
                            <select name="hardware" id= "hardware" class="form-control">
                              <option hidden>Select</option>
                              <option value="1" {{old('hardware') == 1 ? 'selected' : '' }}>With Me</option>
                              <option value="2" {{old('hardware') == 2 ? 'selected' : '' }}>With other team</option>
                              <option value="3" {{old('hardware') == 3 ? 'selected' : '' }}>Submitted to e-Yantra</option>
                              <option value="4" {{old('hardware') == 4 ? 'selected' : '' }}>No Theme Kit</option>
                              
                            </select>
                          </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-6 col-form-label" style = "color:black;font-weight: bold">{{ __('List of hardware that you have(other than theme kit) for immediate use in eYSIP. (ex. Microcontrollers, Sensors, Actuators, etc)') }}</label>
                        <div class="col-sm-6">
                          <div class="input-field {{ $errors->has('otherhw') ? ' has-danger' : '' }}">
                            <input class="form-control" style="margin-left:3%" type="text" name="otherhw" id="otherhw" placeholder="List of hardwares" value="{{ old('otherhw') }}">
                          </div>
                        </div>
                      </div>
                      
                      <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>
                      </div>
                    </form>
                  </div>
                  <div id="test6" class="col s12">
                    <form method="post" action="{{ route('submitSection6') }}" autocomplete="off" 
                      class="form-horizontal">
                      @csrf
                      <div class="row">
                        <label class="col-sm-9 col-form-label">
                          <input name="confirm" value="1" type="checkbox" required />
                          <label style="color:red">I hereby confirm that the information provided by me is true and authentic to the best of my knowledge.</label>
                        </label>
                      </div>
                      <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Submit Profile') }}</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div> 
@endsection

@push('js')
<!--Import jQuery before materialize.js-->
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

<script>
  $(document).ready(function(){
    $('.tabs').tabs();

      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 
    });  
</script>

<script type="text/javascript">
  var k=1;
  var click = 1;
  function addmore()
  {
    k++;  
    incrementValue();
      $('#dynamic_field').append('<tr id="row'+k+'" class="dynamic-added"><td><textarea name="expdtl[]" placeholder="Add Experience Description- (600 characters) (Co-Curricular/Extra-Curricular activities)" rows="5" cols="115"></textarea></td><td align="center"><button type="button" name="remove" id="'+k+'" class="btn btn-danger btn_remove">Remove</button></td></tr>');  
  }

  function incrementValue()
  {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
  }

  $('body').on("click", '.add-btn', function() 
  {
    var $copyContent = $("#copy-this-div").clone();
    $copyContent.find('input').val('');
    $('.parent-div').append($copyContent);
    click++;
    if(click>=3)
    {
      document.getElementById("add_project").disabled = true;
    }
  });
</script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-145861739-9');
</script>
<script type="text/javascript">
  function hideeyrc()
  {
    document.getElementById('showeyrc').style.display ='none';
    $("#theme").prop("required", false);
    $("#hardware").prop("required", false);
  }
  function showeyrc()
  {
    document.getElementById('showeyrc').style.display = 'block';
    $("#theme").prop("required", true);
    $("#hardware").prop("required", true);
  }

  function ShowHideDiv1(chkPassport) 
  {
    var dvtopics = document.getElementById("dvtopics");
    dvtopics.style.display = chkPassport.checked ? "block" : "none";
  }
</script>
@endpush