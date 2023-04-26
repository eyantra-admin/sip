@extends('layouts.app', ['activePage' => 'preference', 'titlePage' => __('Project Preference')])

@section('content') 
  <!-- <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Disclaimers') }}</h4>
        </div>
        <div class="card-body">
          <h4><b>1) Please only choose the projects that you feel you are qualified to do. Do not select a project, just because you want to learn a skill/technology stack.<br><br>
            2) Internship Projects are allocated based on a number of factors such as skill level of candidates, number of vacancies in any particular project etc.
          </b></h4>
        </div>
      </div> -->

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
     
      <div class="col-md-12" style="margin-top: 100px">
        <form method="post" action="{{ route('EvaluationSubmit') }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('put')

          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Evalation Parameters') }}</h4>
            </div>
            <div class="card-body">
              <h3><b>Please apply due deligence while suggesting project for the students.</b></h3><br>

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Student Name') }}</label>
                <div class="col-sm-7">
                  <select class="form-control" name="studentname" id="studentname" required>
                    <option hidden value="">Select Student Name</option>
                      @foreach($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                      @endforeach
                  </select>
                </div>
              </div>

              @if($preferences != null)
                  <div class="row my-4">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-7">
                        <div class="p-2" style="background-color:#ffcdd2;">
                          <p>Students Project Preferences:</p>
                          <ul style="list-style-type: decimal;">
                              <li>
                                <a href="../mentorprojectdetail/{{Crypt::encrypt($preferences->p1_id)}}" target="_blank"> {{$preferences->p1_name}}
                                </a>
                              </li>
                              <li>
                                <a href="../mentorprojectdetail/{{Crypt::encrypt($preferences->p2_id)}}" target="_blank">
                                {{$preferences->p2_name}}
                                </a>
                              </li>
                              <li>
                                <a href="../mentorprojectdetail/{{Crypt::encrypt($preferences->p3_id)}}" target="_blank">
                                {{$preferences->p3_name}}
                                </a>
                              </li>
                              <li>
                                <a href="../mentorprojectdetail/{{Crypt::encrypt($preferences->p4_id)}}" target="_blank">
                                {{$preferences->p4_name}}
                                </a>
                              </li>
                              <li>
                                <a href="../mentorprojectdetail/{{Crypt::encrypt($preferences->p5_id)}}" target="_blank">
                                {{$preferences->p5_name}}</a>
                              </li>
                          </ul>
                        </div>  
                    </div>                    
                  </div>
              @endif

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Project 1') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="form-control" name="projectpref1" id="projectpref1" required>
                      <option hidden value="">Select your first project preference</option>
                      @foreach($projects as $project)
                        <option value="{{$project->id}}" {{old('projectpref1') == $project->id ? 'selected' : ''  }}>{{$project->projectname}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Project 2') }}</label>
                <div class="col-sm-7">
                    <select class="form-control" name="projectpref2" id="projectpref2" required>
                      <option hidden value="">Select your second project preference</option>
                      @foreach($projects as $project)
                        <option value="{{$project->id}}" {{old('projectpref2') == $project->id ? 'selected' : ''  }}>{{$project->projectname}}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Project 3') }}</label>
                <div class="col-sm-7">
                    <select class="form-control" name="projectpref3" id="projectpref3">
                      <option hidden value="">Select your third project preference</option>
                      @foreach($projects as $project)
                        <option value="{{$project->id}}" {{old('projectpref3') == $project->id ? 'selected' : ''  }}>{{$project->projectname}}</option>
                      @endforeach
                    </select>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Decision') }}</label>
                <div class="col-sm-4">
                    <select class="form-control" name="decision" id="decision" required>
                      <option hidden value="0">Select your decision</option>
                        <option value="Yes" style="text-align:center;">Yes</option>
                        <option value="No" style="text-align:center;">No</option>
                        <option value="May Be" style="text-align:center;">May Be</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Technical Strength') }}</label>
                <div class="col-sm-4">
                    <select class="form-control"  name="technicalstrength" id="technicalstrength" required>
                      <option hidden value="0">Select Technical Strength</option>
                        <option value="Outstanding" style="text-align:center;">Outstanding</option>
                        <option value="Excedds Expectations" style="text-align:center;">Excedds Expectations</option>
                        <option value="Acceptable" style="text-align:center;">Acceptable</option>
                        <option value="Poor" style="text-align:center;">Poor</option>
                        <option value="Dreadful" style="text-align:center;">Dreadful</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Remark') }}</label>
                <div class="col-sm-7">
                    <textarea id= "remark" class="form-control" name="remark" maxlength="2000" placeholder="Short remark for your evaluation " rows="4" required></textarea>
                </div>
              </div>
              
              @if($panel_eval != null)
              <div class="row my-4">
                <div class="col-sm-2"></div>
                <div class="col-sm-7 p-2" style="background-color:#ffcdd2;">
                  <p><b>Panel Decision:</b></p>
                  <p>(If you want to edit/update, Please fill it again and save)</p>
                  Project Preferences decided by Panel:
                  <ul style="list-style-type: decimal;">
                      <li>{{$panel_eval->p1_name}}</li>
                      <li>{{$panel_eval->p2_name}}</li>
                      <li>{{$panel_eval->p3_name}}</li>
                  </ul>
                  <ul style="list-style-type: circle;">
                      <li><b>Decision:</b> {{$panel_eval->decision}}</li>
                      <li><b>Technical Strenth:</b> {{$panel_eval->technicalstrength}}</li>                     
                  </ul>
                  <p>{{$panel_eval->remark}}</p>
                </div>                    
              </div>
              @endif

              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>
              </div>
            </div>
          </div>
        </form>
      </div> 
    </div>
  </div>
@endsection