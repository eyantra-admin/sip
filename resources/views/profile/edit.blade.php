@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('User Profile')])

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
                <h4 class="card-title"><b>{{ __('Edit Profile') }}</b></h4>
            </div>

            <div class="row">
              <div class="row">
                <ul class="tabs">
                  <li class="tab waves-effect waves-light btn"><a class="active" href="#test1">Academic Details</a></li>
                  <li class="tab waves-effect waves-light btn"><a href="#test2">Project Info</a></li>
                  <li class="tab waves-effect waves-light btn"><a href="#test3">Mooc Courses</a></li>
                  <li class="tab waves-effect waves-light btn"><a href="#test4">Experience Details</a></li>
                  <li class="tab waves-effect waves-light btn"><a  href="#test5">e-Yantra Affiliations</a></li>
                  <li class="tab waves-effect waves-light btn"><a  href="#test6">Confirmation</a></li>
                </ul>
              

                <div class="card-body">
                  <div id="test1" class="col s12">
                    <form method="post" action="{{ route('profile.updateSection1') }}" autocomplete="off" 
                      class="form-horizontal">
                      @csrf 
                      {{ method_field('PUT') }}
                      <div class="row">
                        <label class="col-sm-3 col-form-label">{{ __('Name') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('fullname') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="name" id="name" readonly placeholder="Name" value="{{ old('fullname', auth()->user()->name) }}" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-3 col-form-label">{{ __('Email Id') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('email') ? ' has-danger' : '' }}">
                            <input class="form-control" name="email" id="email" placeholder="Email Id Email Id" readonly value="{{ old('fullname', auth()->user()->email) }}" rows="4" wrap="physical" required>
                          </div>
                        </div>

                        <label class="col-sm-3 col-form-label">{{ __('Contact No') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="phone" id="phone" placeholder="Contact No" value="{{ $data->phone }}" required>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-3 col-form-label">{{ __('College') }}</label>
                        <div class="col-sm-9">
                          <div class="input-field {{ $errors->has('college') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="college" id="college" readonly value="{{$data->college}}" required>
                            <!-- <select class="form-control" id="college" name="college" 
                                    value="{{old('college')}}" required>
                                <option hidden value="">Select your college</option>
                                @foreach($colleges as $college)
                                <option value="{{$college->clg_code}}" {{old('college') == $college->clg_code ? 'selected' : ''  }}>{{$college->college_name}}</option>
                                @endforeach
                            </select> -->
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-3 col-form-label">{{ __('Select Year') }}</label>
                        <div class="col-sm-3">
                          <select id="year" class="form-control" name="year" required>
                            <option hidden value="">Select year</option>
                            <option value="1" {{$data->year == 1 ? 'selected': '' }}>First year</option>
                            <option value="2" {{$data->year == 2 ? 'selected': '' }}>Second year</option>
                            <option value="3" {{$data->year == 3 ? 'selected': '' }}>Third year</option>
                            <option value="4" {{$data->year == 4 ? 'selected': '' }}>Fourth year</option>
                          </select>
                        </div>
                      
                        <label class="col-sm-3 col-form-label">{{ __('Select Department') }}</label>
                        <div class="col-sm-3">
                          <select class="form-control" id="branch" name="branch" required>
                            <option hidden value="">Select department</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->name }}" {{$data->branch == $department->name ? 'selected' : ''  }}>{{$department->name}}</option>
                                @endforeach
                          </select>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-3 col-form-label">{{ __('Present GPA/ Percentage') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('gpa') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="gpa" id="gpa" placeholder="gpa" value="{{ $data->gpa }}" required>
                          </div>
                        </div>

                        <label class="col-sm-3 col-form-label">{{ __('Class 12 or diploma Percentage') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('class12') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="class12" id="class12" placeholder="class12" value="{{ $data->class12 }}" required>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-3 col-form-label">{{ __('Class 12 Board') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('class12board') ? ' has-danger' : '' }}">
                          <select id="class12board" class="form-control" name="class12board" value="{{old('class12board')}}" required>
                                  <option hidden value="">Select</option>
                                  <option value="HSC" {{ $data->class12board == "HSC" ? 'selected': '' }}>HSC</option>
                                  <option value="CBSE" {{ $data->class12board == "CBSE" ? 'selected': '' }}>CBSE</option>
                                  <option value="ICSE" {{ $data->class12board == "ICSE" ? 'selected': '' }}>ICSE/ISC</option>
                                  <option value="IGCSE" {{ $data->class12board == "IGCSE" ? 'selected': '' }}>IGCSE</option>
                                  <option value="IB" {{ $data->class12board == "IB" ? 'selected': '' }}>IB</option>
                                  <option value="Diploma" {{ $data->class12board == "Diploma" ? 'selected': '' }}>Diploma</option>
                              </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-3 col-form-label">{{ __('Github Link') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('github') ? ' has-danger' : '' }}">
                            <input class="form-control" name="github" id="github" placeholder="Github link" value="{{ $data->github }}"github rows="4" wrap="physical" required>
                          </div>
                        </div>

                        <label class="col-sm-3 col-form-label">{{ __('Linked In') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('linkedin') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="linkedin" id="linkedin" placeholder="Linked In Id" value="{{ $data->linkedin }}" required>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-3 col-form-label">{{ __('Instagram') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('insta') ? ' has-danger' : '' }}">
                            <input class="form-control" name="instagram" id="instagram" placeholder="Instagram Id" value="{{ $data->instagram }}" rows="4" wrap="physical" required>
                          </div>
                        </div>

                        <label class="col-sm-3 col-form-label">{{ __('Facebook') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('fb') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="facebook" id="facebook" placeholder="Facebook Id" value="{{ $data->facebook }}" required>
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
                            <label class="col-sm-3 col-form-label">{{ __('Project Title') }}</label>
                            <div class="col-sm-9">
                              <input class="form-control" type="text" name="projectTitle[]" id="projectTitle" placeholder="Project Title" value="{{ old('projectTitle')}}" required>
                            </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Project Description') }}</label>
                            <div class="col-sm-9">
                              <input class="form-control" name="projDesc[]" id="projDesc" placeholder="Project Desciption" value="{{ old('projDesc') }}" rows="4" wrap="physical" required>
                            </div>
                          </div>

                          <div class="row">
                            <label class="col-sm-3 col-form-label">{{ __('Project Duration') }}</label>
                              <div class="col">
                                <input type="number" class="form-control" placeholder="Project Duration(In months)" name="projDuration[]" id="projDuration" value="{{old('projDuration')}}" required>
                              </div>
                            <label class="col-sm-3 col-form-label">{{ __('No of Team Members') }}</label>
                              <div class="col">
                                <input type="number" class="form-control" name="projMembers[]" id="projMembers" placeholder="No of Team Members" value="{{old('projMembers')}}" required>
                              </div>
                          </div>
                          <div class="row">
                              <label class="col-sm-3 col-form-label">Your role in the project</label>
                              <div class="col-sm-9">
                                <textarea id= "projectRole" class="form-control" name="projectRole[]" maxlength="250" placeholder="Short Description of your role upto 250 characters" rows="2">{{old('projectRole') }}</textarea>
                              </div>
                          </div>
                          <div class="row">
                              <label class="col-sm-3 col-form-label">Github reporsitory of the project (if available)</label>
                              <div class="col-sm-9">
                                <input type="text" id= "projGithub" class="form-control" name="projGithub[]" value="{{old('projGithub')}}">
                              </div>
                          </div>
                          <div class="row">
                              <label class="col-sm-3 col-form-label">Publications (if any)</label>
                              <div class="col-sm-9">
                                <textarea id="projPubl" name="projPubl[]" class="form-control" rows="4" cols="50" placeholder="Publications Link can also be added here, max upto 200 characters">{{old('projPubl') }}</textarea>
                              </div>
                          </div>  
                          <div class="row">
                              <label class="col-sm-3 col-form-label">{{ __('Skills Acquired') }}</label>
                                <div class="col">
                                  <select class="form-control" id="skills1" name="skills1[]" >
                                    <option hidden value="null">Select Skills</option>
                                      @foreach($skills as $skill)
                                      <option value="{{$skill->id}}"  {{old('skills1') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                      @endforeach
                                  </select>
                                </div>
                              <label class="col-sm-3 col-form-label">{{ __('Rating for skill1') }}</label>
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
                              <label class="col-sm-3 col-form-label">{{ __('Skills Acquired') }}</label>
                                <div class="col">
                                  <select class="form-control" id="skills2" name="skills2[]" >
                                    <option hidden value="null">Select Skills</option>
                                      @foreach($skills as $skill)
                                      <option value="{{$skill->id}}"  {{old('skills2') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                      @endforeach
                                  </select>
                                </div>
                              <label class="col-sm-3 col-form-label">{{ __('Rating for skill2') }}</label>
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
                              <label class="col-sm-3 col-form-label">{{ __('Skills Acquired') }}</label>
                                <div class="col">
                                  <select class="form-control" id="skills3" name="skills3[]" >
                                    <option hidden value="null">Select Skills</option>
                                      @foreach($skills as $skill)
                                      <option value="{{$skill->id}}"  {{old('skills3') == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                      @endforeach
                                  </select>
                                </div>
                              <label class="col-sm-3 col-form-label">{{ __('Rating for skill3') }}</label>
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
                    <form method="post" action="{{ route('profileupdate') }}" autocomplete="off" 
                      class="form-horizontal">
                      @csrf
                      {{ method_field('PUT') }}
                      <h6>MOOC Coursework (If any)</h6>
                      <label>If number of courses undertaken is more than 1, please mention them using comma seperation.</label>

                      <div class="row">
                        <label class="col-sm-3 col-form-label">{{ __('Mooc Course Name') }}</label>
                        <div class="col-sm-6">
                          <div class="input-field {{ $errors->has('mooc_course') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="mooc_course" id="mooc_course" placeholder="Mooc Course Name" value="{{ $data->mooc_course }}">
                          </div>
                        </div>
                      </div><br>
                      <div class="row">
                        <label class="col-sm-3 col-form-label">{{ __('Platform') }}</label>
                        <div class="col-sm-9">
                          <input type="checkbox" name="platform[]" value="Coursera" {{ $data->platform == "Coursera" ? 'checked': '' }}>Coursera &nbsp; Coursera  &nbsp; &nbsp; 
                          <input type="checkbox" name="platform[]" value="edX"> &nbsp; edX &nbsp; &nbsp; 
                          <input type="checkbox" name="platform[]" value="e-Yantra MOOC">&nbsp; e-Yantra MOOC &nbsp; &nbsp; 
                          <input type="checkbox" name="platform[]" value="NPTEL">&nbsp; NPTEL &nbsp; &nbsp; 
                          <input type="checkbox" name="platform[]" value="Swayam">&nbsp; Swayam &nbsp;  &nbsp; 
                          <input type="checkbox" name="platform[]" value="Diksha">&nbsp; Diksha &nbsp; &nbsp; 
                          <input type="checkbox" name="platform[]" value="Udemy">&nbsp; Udemy &nbsp; &nbsp; 
                          <input type="checkbox" name="platform[]" value="Other" onclick="ShowHideDiv1(this)">&nbsp; Other &nbsp; &nbsp; 
                          <div id="dvtopics" style="display: none">Other Topics
                            <input type="text" class="form-control" id="txttopics" name="platform[]" />
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-3 col-form-label">{{ __('Number of courses started but not completed') }}</label>
                        <div class="col-sm-6">
                          <input class="form-control" type="text" name="number_of_courses_incomplete" id="number_of_courses_incomplete" placeholder="Mooc course started but not complete" 
                          value="{{ $data->number_of_courses_incomplete }}">
                        </div>
                      </div>
                      <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>
                      </div>
                    </form>
                  </div>
                  <div id="test4" class="col s12">
                    <form method="post" action="{{ route('updateexp') }}" autocomplete="off" 
                        class="form-horizontal">
                        @csrf
                        {{ method_field('PUT') }}
                      <div id="expdtls">
                        <h6>Experience Details</h6>
                        <div class="col-lg-12" id="expdtls"> 
                          <?php $i=1; ?>
                            @foreach($exp as $ex)
                              <div class="panel-body">
                                <div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
                                  <label>Experience {{$i}}</label>
                                  <textarea class="form-control" name="expdtl[]" id="expdtl" rows="10" cols="63">{{$ex->exp_description}}</textarea>   
                                </div>
                              </div>
                          <?php $i+=1; ?>
                            @endforeach                               
                        </div>
                      </div>
                      <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>
                      </div>
                    </form>
                  </div>
                  <div id="test5" class="col s12">
                    <form method="post" action="{{ route('updatecomp') }}" autocomplete="off" 
                      class="form-horizontal">
                      @csrf
                      {{ method_field('PUT') }}
                      <div class="row">
                        <label class="col-sm-6 col-form-label">{{ __('Please mention your affiliation with e-Yantra') }}</label>
                        <div class="col-sm-6">
                          <div>                                   
                            <input type="radio" id="eyrc" name="eyrc_eyic_participating" value="eyrc" {{ $data->eyrc_eyic_participating == 'eyrc' ? 'checked' : '' }} onclick="showeyrc();" required>
                            <label for="eyrc">eYRC</label>
                          </div>
                          <div class="radio">
                            <input type="radio" id="eyic" name="eyrc_eyic_participating" value="eyic" {{$data->eyrc_eyic_participating == 'eyic' ? 'checked' : '' }} onclick="hideeyrc();">
                            <label for="eyic">eYIC</label>
                          </div>
                          <div class="radio">
                            <input type="radio" id="mooc" name="eyrc_eyic_participating" value="mooc" {{$data->eyrc_eyic_participating == 'mooc' ? 'checked' : '' }} onclick="hideeyrc();">
                            <label for="mooc">MOOC</label>
                          </div>
                          <div class="radio">
                            <input type="radio" id="hackathon" name="eyrc_eyic_participating" value="hackathon" {{$data->eyrc_eyic_participating == 'hackathon' ? 'checked' : '' }} onclick="hideeyrc();">
                                  <label for="mooc">Hackathon</label>
                          </div>
                          <div class="radio">
                            <input type="radio" id="design" name="eyrc_eyic_participating" value="design" {{$data->eyrc_eyic_participating == 'design' ? 'checked' : '' }} onclick="hideeyrc();">
                            <label for="mooc">Design Sprint</label>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div id="showeyrc" style="display: none;">
                          <label class="col-sm-3 col-form-label">{{ __('eYRC Theme') }}</label>
                          <div class="col-lg-3">
                            <select name="eyrc_theme" id="eyrc_theme" class="form-control">
                              <option hidden>Select theme</option>
                              <option value="Vitarana Drone" {{ $data->eyrc_theme == 'Vitarana Drone' ? 'selected' : '' }}>Vitarana Drone (VD)</option>
                              <option value="Sahayak Bot" {{$data->eyrc_theme == 'Sahayak Bot' ? 'selected' : '' }}>Sahayak Bot (SB)</option>
                              <option value="Sankatmochan Bot" {{$data->eyrc_theme == 'Sankatmochan Bot' ? 'selected' : '' }}>Sankatmochan Bot (SM)</option>
                              <option value="Vargi Bot" {{$data->eyrc_theme == 'Vargi Bot' ? 'selected' : '' }}>Vargi Bots (VB)</option>
                              <option value="Nirikshak Bot" {{$data->eyrc_theme == 'Nirikshak Bot' ? 'selected' : '' }}>Nirikshak Bots (NB)</option>
                            </select>
                          </div>
                          <label class="col-sm-3 col-form-label">{{ __('Where is your Theme Kit?') }}</label>
                          <div class="col-lg-3">
                            <select name="where_is_your_hardware" id= "where_is_your_hardware" class="form-control">
                              <option hidden>Select</option>
                              <option value="1" {{ $data->where_is_your_hardware == 1 ? 'selected' : '' }}>With Me</option>
                              <option value="2" {{$data->where_is_your_hardware  == 2 ? 'selected' : '' }}>With other team</option>
                              <option value="3" {{$data->where_is_your_hardware  == 3 ? 'selected' : '' }}>Submitted to College</option>
                              <option value="4" {{$data->where_is_your_hardware  == 4 ? 'selected' : '' }}>No Theme Kit</option>
                              
                            </select>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-6 col-form-label">{{ __('List of hardware that you have(other than theme kit) for immediate use in eYSIP. (ex. Microcontrollers, Sensors, Actuators, etc)') }}</label>
                        <div class="col-sm-6">
                          <div class="input-field {{ $errors->has('otherhw') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="otherhw" id="otherhw" placeholder="List of hardwares" value="{{ $data->otherhw }}">
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
                        {{ __('I hereby confirm that the information provided by me is true and authentic to the best of my knowledge.') }}</label>
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
      $('#dynamic_field').append('<tr id="row'+k+'" class="dynamic-added"><td><textarea name="expdtl[]" placeholder="Enter your experience" rows="5" cols="115"></textarea></td><td align="center"><button type="button" name="remove" id="'+k+'" class="btn btn-danger btn_remove">Remove</button></td></tr>');  
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
    var copyContent = $("#copy-this-div").clone();
    $('.parent-div').append(copyContent);
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
