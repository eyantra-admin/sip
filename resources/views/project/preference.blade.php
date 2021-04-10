@extends('layouts.app', ['activePage' => 'preference', 'titlePage' => __('Project Preference')])

@section('content') 
  <div class="content">
    <div class="container-fluid">
      <div class = "row">
         <div class="col-md-12" style="margin-top: 25px">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Project List</h4>
              <p class="card-category"> List of all available projects along with its details.</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="project_table" style="text-align: center;"> 
                    <thead class="thead-inverse">
                      <tr>
                        <th>Sr. #</th>
                        <th>Project Name</th>
                        <th>Abstract</th>
                        <th>Project Details</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($projects as $key=>$cur)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$cur->projectname}}</td>
                        <td>{{$cur->projectdesc}}</td>
                        <td><a href="projectdetail/{{ $cur->id }}" target="_blank">View Detail</a></td>
                        
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
        </div>
      </div>
         
      <!-- ------Preference table------- -->
      <div class="col-md-12" style="margin-top: 100px">
        <form method="post" action="{{ route('project.preferenceupdate') }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('put')

          @if($errors->any())
          <div class="alert alert-danger" role='alert'>
          @foreach($errors->all() as $error)
          <p>{!!$error!!}</p>
          @endforeach
          </div>
          <hr/>
          @endif

          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Project Preferences') }}</h4>
              <p class="card-category">{{ __('Select your project preferences based on the skills you acquire') }}</p>
            </div>
            <div class="card-body">
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

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Project 1') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12" name="project_preference_1" id="projectpref1" required>
                      <option hidden value="0">Select your first project preference</option>
                      @foreach($projects as $project)
                        <option value="{{$project->id}}" {{old('project') == $project->id ? 'selected' : ''  }}>{{$project->projectname}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('project_preference_1'))
                      <span id="projectpref1-error" class="error text-danger" for="project_preference_1">{{ $errors->first('project_preference_1') }}</span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Project 2') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12" name="project_preference_2" id="projectpref2" required>
                      <option hidden value="0">Select your second project preference</option>
                      @foreach($projects as $project)
                        <option value="{{$project->id}}" {{old('project') == $project->id ? 'selected' : ''  }}>{{$project->projectname}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('project_preference_2'))
                      <span id="projectpref2-error" class="error text-danger" for="project_preference_2">{{ $errors->first('project_preference_2') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Project 3') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12" name="project_preference_3" id="projectpref3" required>
                      <option hidden value="0">Select your third project preference</option>
                      @foreach($projects as $project)
                        <option value="{{$project->id}}" {{old('project') == $project->id ? 'selected' : ''  }}>{{$project->projectname}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('project_preference_3'))
                      <span id="projectpref3-error" class="error text-danger" for="project_preference_3">{{ $errors->first('project_preference_3') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <center>
                <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
              </div>
              </center>
              
            </div>
          </div>
        </form>
      </div> 
    </div>
  </div>
@endsection
