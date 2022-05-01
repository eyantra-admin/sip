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
                      </div>  
                      <div class="row">
                      <label class="col-sm-3 col-form-label">{{ __('College') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('college') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="college" id="college"  value="{{$data->college}}" required readonly>
                            <!-- <select class="form-control" id="college" name="college"  readonly
                                    value="{{old('college')}}" required>
                                <option hidden value="">Select your college</option>
                                @foreach($colleges as $college)
                                <option value="{{$college->clg_code}}" {{old('college') == $college->clg_code ? 'selected' : ''  }}>{{$college->college_name}}</option>
                                @endforeach
                            </select> -->
                          </div>
                        </div>
                      </div> 
                      <hr style="background-color:red">
                      <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Contact No') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="phone" id="phone" placeholder="Contact No" value="{{ $data->phone }}" required <?php if($form_submitted == 1) echo "readonly";?>>
                          </div>
                        </div>

                        <label class="col-sm-2 col-form-label">{{ __('Select Year') }}</label>
                        <div class="col-sm-3">
                          <select id="year" class="form-control" name="year" required <?php if($form_submitted == 1) echo "readonly";?>>
                            <option hidden value="">Select year</option>
                            <option value="1" {{$data->year == 1 ? 'selected': '' }}>First year</option>
                            <option value="2" {{$data->year == 2 ? 'selected': '' }}>Second year</option>
                            <option value="3" {{$data->year == 3 ? 'selected': '' }}>Third year</option>
                            <option value="4" {{$data->year == 4 ? 'selected': '' }}>Fourth year</option>
                          </select>
                        </div>
                        
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Select Department') }}</label>
                        <div class="col-sm-3">
                          <select class="form-control" id="branch" name="branch" required <?php if($form_submitted == 1) echo "readonly";?>>
                            <option hidden value="">Select department</option>
                                @foreach($departments as $department)
                                <option value="{{ $department->name }}" {{$data->branch == $department->name ? 'selected' : ''  }}>{{$department->name}}</option>
                                @endforeach
                          </select>
                        </div>

                        <label class="col-sm-2 col-form-label">{{ __('Present GPA/ Percentage') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('gpa') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="gpa" id="gpa" placeholder="gpa" value="{{ $data->gpa }}" required <?php if($form_submitted == 1) echo "readonly";?>>
                          </div>
                        </div>
                      </div>


                      <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('12th/diploma %') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('class12') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="class12" id="class12" placeholder="class12" value="{{ $data->class12 }}" required <?php if($form_submitted == 1) echo "readonly";?>>
                          </div>
                        </div>

                        <label class="col-sm-2 col-form-label">{{ __('Class 12 Board') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('class12board') ? ' has-danger' : '' }}">
                              <select id="class12board" class="form-control" name="class12board" value="{{old('class12board')}}" required <?php if($form_submitted == 1) echo "readonly";?>>
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
                        <label class="col-sm-2 col-form-label">{{ __('Github Link') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('github') ? ' has-danger' : '' }}">
                            <input class="form-control" name="github" id="github" placeholder="Github link" value="{{ $data->github }}"github rows="4" wrap="physical" required <?php if($form_submitted == 1) echo "readonly";?>>
                          </div>
                        </div>
                     
                        <label class="col-sm-2 col-form-label">{{ __('Linked In') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('linkedin') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="linkedin" id="linkedin" placeholder="Linked In Id" value="{{ $data->linkedin }}" required <?php if($form_submitted == 1) echo "readonly";?>>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Instagram') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('insta') ? ' has-danger' : '' }}">
                            <input class="form-control" name="instagram" id="instagram" placeholder="Instagram Id" value="{{ $data->instagram }}" rows="4" wrap="physical"  <?php if($form_submitted == 1) echo "readonly";?>>
                          </div>
                        </div>
                       
                        <label class="col-sm-2 col-form-label">{{ __('Facebook') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('fb') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="facebook" id="facebook" placeholder="Facebook Id" value="{{ $data->facebook }}" <?php if($form_submitted == 1) echo "readonly";?>>
                          </div>
                        </div>
                      </div>

                      <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>
                      </div>
                    </form>
                  </div>
                  <div id="test2" class="col s12">
                    <form method="post" action="{{ route('updateproj') }}" autocomplete="off" 
                      class="form-horizontal">
                      @csrf
                      {{ method_field('PUT') }}
                      @foreach($project as $project)
                        <div class="row parent-div">
                          <div class="col-md-12" id="copy-this-div">
                            <div class="row">
                              <label class="col-sm-3 col-form-label">{{ __('Project Title') }}</label>
                              <div class="col-sm-6">
                                <input class="form-control" type="text" name="projectTitle[]" id="projectTitle" placeholder="Project Title" value="{{ $project->projectTitle}}" required <?php if($form_submitted == 1) echo "readonly";?>>
                              </div>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label">{{ __('Project Description') }}</label>
                              <div class="col-sm-6">
                                <input class="form-control" name="projDesc[]" id="projDesc" placeholder="Project Desciption" value="{{ $project->projDesc }}" rows="4" wrap="physical" required <?php if($form_submitted == 1) echo "readonly";?>>
                              </div>
                            </div>

                            <div class="row">
                              <label class="col-sm-3 col-form-label">{{ __('Project Duration') }}</label>
                                <div class="col-sm-6">
                                  <input type="number" class="form-control" name="projDuration[]" id="projDuration" value="{{ $project->projDuration}}" required <?php if($form_submitted == 1) echo "readonly";?>>
                              </div>
                            </div>
                                <div class="row">  
                              <label class="col-sm-3 col-form-label">{{ __('No of Team Members') }}</label>
                                <div class="col-sm-6">
                                  <input type="number" class="form-control" name="projMembers[]" id="projMembers" placeholder="No of Team Members" value="{{ $project->projMembers }}" required <?php if($form_submitted == 1) echo "readonly";?>>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label">Your role in the project</label>
                                <div class="col-sm-6">
                                  <textarea id= "projectRole" class="form-control" name="projectRole[]" maxlength="250" placeholder="Short Description of your role upto 250 characters" rows="2" <?php if($form_submitted == 1) echo "readonly";?>>{{ $project->projectRole }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label">Github reporsitory of the project (if available)</label>
                                <div class="col-sm-6">
                                  <input type="text" id= "projGithub" class="form-control" name="projGithub[]" value="{{ $project->projGithub}}" <?php if($form_submitted == 1) echo "readonly";?>>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-3 col-form-label">Publications (if any)</label>
                                <div class="col-sm-6">
                                  <textarea id="projPubl" placeholder="Start typing here....."name="projPubl[]" class="form-control" rows="4" cols="50" <?php if($form_submitted == 1) echo "readonly";?>>{{ $project->projPubl }}</textarea>
                                </div>
                            </div>  
                            <div class="row">
                                <label class="col-sm-3 col-form-label">{{ __('Skills Acquired') }}</label>
                                  <div class="col">
                                    <select class="form-control" id="skills1" name="skills1[]" <?php if($form_submitted == 1) echo "readonly";?>>
                                      <option hidden value="null">Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{ $project->skills1 == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                <label class="col-sm-3 col-form-label">{{ __('Rating for skill1') }}</label>
                                  <div class="col">
                                    <select class="form-control" name="rating1[]" id= "rating1" <?php if($form_submitted == 1) echo "readonly";?>>
                                      <option hidden>Select</option>
                                      <option value="Rookie" {{$project->rating1 == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                      <option value="Novice" {{ $project->rating1 == 'Novice' ? 'selected' : '' }}>Novice</option>
                                      <option value="Master" {{ $project->rating1 == 'Master' ? 'selected' : '' }}>Master</option>
                                      <option value="Pro" {{ $project->rating1 == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                  </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label">{{ __('Skills Acquired') }}</label>
                                  <div class="col">
                                    <select class="form-control" id="skills2" name="skills2[]" <?php if($form_submitted == 1) echo "readonly";?>>
                                      <option hidden value="null">Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{ $project->skills2 == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                <label class="col-sm-3 col-form-label">{{ __('Rating for skill2') }}</label>
                                  <div class="col">
                                    <select class="form-control" name="rating2[]" id= "rating2" <?php if($form_submitted == 1) echo "readonly";?>>
                                      <option hidden>Select</option>
                                      <option value="Rookie" {{ $project->rating2 == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                      <option value="Novice" {{ $project->rating2 == 'Novice' ? 'selected' : '' }}>Novice</option>
                                      <option value="Master" {{ $project->rating2 == 'Master' ? 'selected' : '' }}>Master</option>
                                      <option value="Pro" {{ $project->rating2 == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                  </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-3 col-form-label">{{ __('Skills Acquired') }}</label>
                                  <div class="col">
                                    <select class="form-control" id="skills3" name="skills3[]" <?php if($form_submitted == 1) echo "readonly";?>>
                                      <option hidden value="null">Select Skills</option>
                                        @foreach($skills as $skill)
                                        <option value="{{$skill->id}}"  {{ $project->skills3 == $skill->id ? 'selected' : ''  }}>{{$skill->skill}}</option>
                                        @endforeach
                                    </select>
                                  </div>
                                <label class="col-sm-3 col-form-label">{{ __('Rating for skill3') }}</label>
                                  <div class="col">
                                    <select class="form-control" name="rating3[]" id= "rating3" <?php if($form_submitted == 1) echo "readonly";?>>
                                      <option hidden>Select</option>
                                      <option value="Rookie" {{ $project->rating3 == 'Rookie' ? 'selected' : '' }}>Rookie</option>
                                      <option value="Novice" {{ $project->rating3 == 'Novice' ? 'selected' : '' }}>Novice</option>
                                      <option value="Master" {{ $project->rating3 == 'Master' ? 'selected' : '' }}>Master</option>
                                      <option value="Pro" {{ $project->rating3 == 'Pro' ? 'selected' : '' }}>Pro</option>
                                    </select>
                                  </div>
                            </div>

                            <hr style="background-color: Red">
                            <br>
                          </div>
                        </div>
                      @endforeach
                      <!-- <div class="col-md-12">
                        <button type="button" id="add_project" class="btn btn-success add-btn">Add More Projects</button>
                      </div> -->

                      <div class="card-footer ml-auto mr-auto">
                        <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>
                      </div>
                    </form>
                  </div>
                  <div id="test3" class="col s12">
                    <!-- <form method="post" action="{{ route('profileupdate') }}" autocomplete="off" 
                      class="form-horizontal"> -->
                    <form method="post" action="{{ route('moocCourses') }}" autocomplete="off" 
                      class="form-horizontal">
                      @csrf
                      {{ method_field('PUT') }}
                      <h5 style = "font-weight: bold; padding-left:3%;">MOOC Coursework (If any)</h5>
                      <label style = "color:red; padding-left:2%;">If number of courses undertaken is more than 1, please mention them using comma seperation.</label>

                      <div class="row">
                        <label class="col-sm-3 col-form-label">{{ __('Mooc Course Name') }}</label>
                        <div class="col-sm-6">
                          <div class="input-field {{ $errors->has('mooc_course') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="mooc_course" id="mooc_course" placeholder="Mooc Course Name" value="{{ $data->mooc_course }}" <?php if($form_submitted == 1) echo "readonly";?>>
                          </div>
                        </div>
                      </div><br>
                      <div class="row">
                        <label class="col-sm-3 col-form-label">{{ __('Platform') }}</label>
                        <div class="col-sm-8">
                          <!-- @php echo gettype($data->platform)  @endphp
                          @php echo $data->platform  @endphp -->
                         @php $str_arr = explode (",", $data->platform); @endphp 
                          <input type="checkbox" name="platform[]" value="Coursera" <?php if(in_array( "Coursera", $str_arr))  echo "checked"; ?> <?php if($form_submitted == 1) echo "onclick='return false'";?>>Coursera &nbsp;  
                          <input type="checkbox" name="platform[]" value="edX" <?php if(in_array( "edX", $str_arr))  echo "checked"; ?> <?php if($form_submitted == 1) echo "onclick='return false'";?>> &nbsp; edX &nbsp; &nbsp; 
                          <input type="checkbox" name="platform[]" value="e-Yantra MOOC" <?php if (in_array( "e-Yantra MOOC", $str_arr))  echo "checked"; ?> <?php if($form_submitted == 1) echo "onclick='return false'";?>>&nbsp; e-Yantra MOOC &nbsp; &nbsp; 
                          <input type="checkbox" name="platform[]" value="NPTEL" <?php if(in_array( "NPTEL", $str_arr))  echo "checked"; ?> <?php if($form_submitted == 1) echo "onclick='return false'";?>>&nbsp; NPTEL &nbsp; &nbsp; 
                          <input type="checkbox" name="platform[]" value="Swayam" <?php if(in_array( "Swayam", $str_arr))  echo "checked"; ?> <?php if($form_submitted == 1) echo "onclick='return false'";?>>&nbsp; Swayam &nbsp;  &nbsp; 
                          <input type="checkbox" name="platform[]" value="Diksha" <?php if(in_array( "Diksha", $str_arr))  echo "checked"; ?> <?php if($form_submitted == 1) echo "onclick='return false'";?>>&nbsp; Diksha &nbsp; &nbsp; 
                          <input type="checkbox" name="platform[]" value="Udemy" <?php if(in_array( "Udemy", $str_arr))  echo "checked"; ?> <?php if($form_submitted == 1) echo "onclick='return false'";?>>&nbsp; Udemy &nbsp; &nbsp; 
                          <!-- <input type="checkbox" name="platform[]" value="Other" <?php if($form_submitted == 1) echo "onclick='return false'";?> onclick="ShowHideDiv1(this)">&nbsp; Other &nbsp; &nbsp;  -->
                          <!-- <div id="dvtopics" style="display: none">Other Topics
                            <input type="text" class="form-control" id="txttopics" name="platform[]" />
                          </div> -->
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-3 col-form-label">{{ __('No. of incompleted courses') }}</label>
                        <div class="col-sm-6">
                          <input class="form-control" type="text" name="number_of_courses_incomplete" id="number_of_courses_incomplete" placeholder="Mooc course started but not complete" 
                          value="{{ $data->number_of_courses_incomplete }}" <?php if($form_submitted == 1) echo "readonly";?>>
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
                      <h5 style = "font-weight: bold; padding-left:3%;">Experience Details (Adding atleast 1 experience is mandatory)</h5>
                        <div class="col-lg-12" id="expdtls"> 
                          <?php $i=1; ?>
                            @foreach($exp as $ex)
                              <div class="panel-body">
                                <div class="form-group col-lg-10 form-group-lg col-lg-offset-1">
                                  <label>Experience {{$i}}</label>
                                  <textarea style="margin-left:2%;" class="form-control" name="expdtl[]" id="expdtl" rows="10" cols="63" <?php if($form_submitted == 1) echo "readonly";?>>{{$ex->exp_description}}</textarea>   
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
                    
                      <form method="post" action="{{ route('updateAffiliation') }}" autocomplete="off" 
                      class="form-horizontal">
                      
                      @csrf
                      {{ method_field('PUT') }}
                      <div class="row">
                        <label class="col-sm-6 col-form-label" style = "color:black;font-weight: bold">{{ __('Please mention your affiliation with e-Yantra') }}</label>
                        <div class="col-sm-6 col-form-label" style="margin-left:3%">
                          <div>                                   
                            <input type="radio" id="eyrc" name="eyrc_eyic_participating" <?php if($form_submitted == 1) echo "onclick='return false'";?> value="eyrc" {{ $data->eyrc_eyic_participating == 'eyrc' ? 'checked' : '' }} onclick="showeyrc();" required>
                            <label for="eyrc">eYRC</label>
                          </div>
                          <div class="radio">
                            <input type="radio" id="eyic" name="eyrc_eyic_participating" <?php if($form_submitted == 1) echo "onclick='return false'";?> value="eyic" {{$data->eyrc_eyic_participating == 'eyic' ? 'checked' : '' }} onclick="hideeyrc();">
                            <label for="eyic">eYIC</label>
                          </div>
                          <div class="radio">
                            <input type="radio" id="mooc" name="eyrc_eyic_participating" <?php if($form_submitted == 1) echo "onclick='return false'";?> value="mooc" {{$data->eyrc_eyic_participating == 'mooc' ? 'checked' : '' }} onclick="hideeyrc();">
                            <label for="mooc">MOOC</label>
                          </div>
                          <div class="radio">
                            <input type="radio" id="hackathon" name="eyrc_eyic_participating" <?php if($form_submitted == 1) echo "onclick='return false'";?> value="hackathon" {{$data->eyrc_eyic_participating == 'hackathon' ? 'checked' : '' }} onclick="hideeyrc();">
                                  <label for="mooc">Hackathon</label>
                          </div>
                          <div class="radio">
                            <input type="radio" id="design" name="eyrc_eyic_participating" <?php if($form_submitted == 1) echo "onclick='return false'";?> value="design" {{$data->eyrc_eyic_participating == 'design' ? 'checked' : '' }} onclick="hideeyrc();">
                            <label for="mooc">Design Sprint</label>
                          </div>
                        </div>
                      </div>

                      <div class="col-lg-12">
                        <div id="showeyrc" style="display: none;">
                          <div class="row">
                          <label class="col-sm-3 col-form-label"><b>{{ __('eYRC Theme') }}</b></label>
                          <div class="col-lg-2">
                            <select name="eyrc_theme" id="eyrc_theme" class="form-control" <?php if($form_submitted == 1) echo "readonly";?>>
                              <option hidden>Select theme</option>
                              <option value="Agribot" {{ $data->eyrc_theme == 'Agribot' ? 'selected' : '' }}>Agribot (AB)</option>
                              <option value="Berryminator" {{$data->eyrc_theme == 'Berryminator' ? 'selected' : '' }}>Berryminator(BM)</option>
                              <option value="Dairy Bike" {{$data->eyrc_theme == 'Dairy Bike' ? 'selected' : '' }}>Dairy Bike (DB)</option>
                              <option value="Functional Weeder" {{$data->eyrc_theme == 'Functional Weeder' ? 'selected' : '' }}>Functional Weeder (FW)</option>
                              <option value="Soil Mointoring" {{$data->eyrc_theme == 'Soil Mointoring' ? 'selected' : '' }}>Soil Mointoring (SM)</option>
                              <option value="Strawberry Stacker" {{$data->eyrc_theme == 'Strawberry Stacker' ? 'selected' : '' }}>Strawberry Stacker (SS)</option>
                            </select>
                          </div>
                          <label class="col-sm-3 col-form-label"><b>{{ __('Where is your Theme Kit?') }}</b></label>
                          <div class="col-lg-2">
                            <select name="where_is_your_hardware" id= "where_is_your_hardware" class="form-control" <?php if($form_submitted == 1) echo "readonly";?>>
                              <option hidden>Select</option>
                              <option value="1" {{ $data->where_is_your_hardware == 1 ? 'selected' : '' }}>With Me</option>
                              <option value="2" {{$data->where_is_your_hardware  == 2 ? 'selected' : '' }}>With other team</option>
                              <option value="3" {{$data->where_is_your_hardware  == 3 ? 'selected' : '' }}>Submitted to College</option>
                              <option value="4" {{$data->where_is_your_hardware  == 4 ? 'selected' : '' }}>No Theme Kit</option>
                              
                            </select>
                          </div>
                          <hr style="background-color:red">
                        </div>
                        </div>
                      </div>

                      <div class="row">
                        <label class="col-sm-6 col-form-label">{{ __('List of hardware that you have(other than theme kit) for immediate use in eYSIP. (ex. Microcontrollers, Sensors, Actuators, etc)') }}</label>
                        <div class="col-lg-2">
                          <div class="input-field {{ $errors->has('otherhw') ? ' has-danger' : '' }}">
                            <input class="form-control" style="margin-left:3%" type="text" name="otherhw" id="otherhw" placeholder="List of hardwares" value="{{ $data->otherhw }}" <?php if($form_submitted == 1) echo "readonly";?>>
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
                        <?php if($form_submitted == 1) echo "<label style='color:red'>The form has already been submitted, now the submission is not possible.</label><br>";
                              else {
                                echo '<input name="confirm" value="1" type="checkbox" required/>';
                                echo '<label style="color:red">I hereby confirm that the information provided by me is true and authentic to the best of my knowledge. </label>';
                              }
                        ?>
                        </label>
                      </div>
                      <div class="card-footer ml-auto mr-auto">
                      <?php if($form_submitted == 0) echo '<button type="submit" class="btn btn-primary"  style="margin-left: 500px">Submit Profile</button>';
                      ?>
                        <!-- <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Submit Profile') }}</button> -->
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
