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
        <form method="post" action="{{ route('Progress_EvalSubmit') }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('put')

          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Evalation Parameters') }}</h4>
            </div>
            <div class="card-body">
              <h3><b>Please apply due deligence while evaluating the interns.</b></h3><br>

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Intern Name') }}</label>
                <div class="col-sm-7">
                  <select class="form-control" name="internname" id="internname" required>
                    <option hidden value="0">Select Intern Name</option>
                      @foreach($interns as $intern)
                        <option value="{{ $intern->id }}">{{ $intern->name }}</option>
                      @endforeach
                  </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Project') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="form-control" name="projectpref1" id="projectpref1" required>
                      <option hidden value="0">Select Project Name</option>
                      @foreach($projects as $project)
                        <option value="{{$project->id}}" {{old('projectpref1') == $project->id ? 'selected' : ''  }}>{{$project->projectname}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Skillset match w.r.t project') }}</label>
                <div class="col-sm-4">
                    <select class="form-control" name="skillset" id="skillset" required>
                      <option hidden value="0">Select your decision</option>
                        <option value="Yes" style="text-align:center;">Yes</option>
                        <option value="No" style="text-align:center;">No</option>
                        <option value="Somewhat" style="text-align:center;">Somewhat</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Technical Strength') }}</label>
                <div class="col-sm-4">
                    <select class="form-control"  name="technicalstrength" id="technicalstrength" required>
                      <option hidden value="0">Select Technical Strength</option>
                        <option value="Outstanding" style="text-align:center;">Outstanding</option>
                        <option value="Exceeds Expectations" style="text-align:center;">Exceeds Expectations</option>
                        <option value="Acceptable" style="text-align:center;">Acceptable</option>
                        <option value="Poor" style="text-align:center;">Poor</option>
                        <option value="Dreadful" style="text-align:center;">Dreadful</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Efforts') }}</label>
                <div class="col-sm-4">
                    <select class="form-control"  name="efforts" id="efforts" required>
                      <option hidden value="0">Select efforts applied</option>
                        <option value="Outstanding" style="text-align:center;">Outstanding</option>
                        <option value="Exceeds Expectations" style="text-align:center;">Exceeds Expectations</option>
                        <option value="Acceptable" style="text-align:center;">Acceptable</option>
                        <option value="Poor" style="text-align:center;">Poor</option>
                        <option value="Dreadful" style="text-align:center;">Dreadful</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Output so far') }}</label>
                <div class="col-sm-4">
                    <select class="form-control"  name="output" id="output" required>
                      <option hidden value="0">Select output so far</option>
                        <option value="Outstanding" style="text-align:center;">Outstanding</option>
                        <option value="Exceeds Expectations" style="text-align:center;">Exceeds Expectations</option>
                        <option value="Acceptable" style="text-align:center;">Acceptable</option>
                        <option value="Poor" style="text-align:center;">Poor</option>
                        <option value="Dreadful" style="text-align:center;">Dreadful</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Academic Load') }}</label>
                <div class="col-sm-4">
                    <select class="form-control"  name="academic" id="academic" required>
                      <option hidden value="0">Select Academic Load</option>
                        <option value="No" style="text-align:center;">No</option>
                        <option value="Hardly any lectures" style="text-align:center;">Hardly any lectures</option>
                        <option value="Manageable no. of lectures" style="text-align:center;">Manageable no. of lectures</option>
                        <option value="Too many lectures but managing" style="text-align:center;">Too many lectures but managing</option>
                        <option value="Too many lectures and may backout" style="text-align:center;">Too many lectures and may backout</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Extention required for the project') }}</label>
                <div class="col-sm-4">
                    <select class="form-control" name="extention" id="extention" required>
                      <option hidden value="0">Select your decision</option>
                        <option value="Yes" style="text-align:center;">Yes</option>
                        <option value="No" style="text-align:center;">No</option>
                        <option value="Maybe" style="text-align:center;">Maybe</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Communication with teammates') }}</label>
                <div class="col-sm-4">
                    <select class="form-control" name="communication" id="communication" required>
                      <option hidden value="0">Select your decision</option>
                        <option value="N/A" style="text-align:center;">N/A</option>
                        <option value="Strongly Disagree" style="text-align:center;">Strongly Disagree</option>
                        <option value="Strongly Agree" style="text-align:center;">Strongly Agree</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Mentor Comments') }}</label>
                <div class="col-sm-7">
                    <textarea id= "remark" class="form-control" name="remark" maxlength="2000" placeholder="Short remark for your evaluation " rows="4" required></textarea>
                </div>
              </div>
              
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