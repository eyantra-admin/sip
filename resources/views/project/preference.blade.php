@extends('layouts.app', ['activePage' => 'preference', 'titlePage' => __('Project Preference')])

@section('content') 
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Disclaimers') }}</h4>
        </div>
        <div class="card-body">
          <h3><b>1) Please only choose the projects that you feel you are qualified to do. Do not select a project, just because you want to learn a skill/technology stack.<br><br>
            2) Internship Projects are allocated based on a number of factors such as skill level of candidates, number of vacancies in any particular project etc. It is possible that you may not be allocated a project out of your 5 given choices. We strive to find the best fit for each project, and try to do that by thoroughly assessing the candidate's skills during the internship. No requests for changing project once allocated will be  entertained.
          </b></h3>
        </div>
      </div>

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
                <thead class=" text-primary">
                  <th><b>Sr No.</b></th>
                  <th><b>Project Name</b></th>
                  <th><b>Project Details</b></th>
                </thead>
                    <tbody>
                      @foreach($projects as $key=>$cur)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$cur->projectname}}</td>
                        <!-- <td>{{$cur->projectdesc}}</td> -->
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

          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Project Preferences') }}</h4>
              <p class="card-category">{{ __('Select your project preferences based on the skills you acquire') }}</p>
            </div>
            <div class="card-body">
              <h3>Please select 5 different projects below. </h3><br>
              <h3>Please apply due deligence while adding project preferences. Preferences once added cannot be modified.</h3><br>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Project 1') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12" name="project_preference_1" id="projectpref1" required>
                      <option hidden value="0">Select your first project preference</option>
                      @foreach($projects as $project)
                        <option value="{{$project->id}}" {{old('projectpref1') == $project->id ? 'selected' : ''  }}>{{$project->projectname}}</option>
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
                        <option value="{{$project->id}}" {{old('projectpref2') == $project->id ? 'selected' : ''  }}>{{$project->projectname}}</option>
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
                        <option value="{{$project->id}}" {{old('projectpref3') == $project->id ? 'selected' : ''  }}>{{$project->projectname}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('project_preference_3'))
                      <span id="projectpref3-error" class="error text-danger" for="project_preference_3">{{ $errors->first('project_preference_3') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Project 4') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12" name="project_preference_4" id="projectpref4" required>
                      <option hidden value="0">Select your fourth project preference</option>
                      @foreach($projects as $project)
                        <option value="{{$project->id}}" {{old('projectpref4') == $project->id ? 'selected' : ''  }}>{{$project->projectname}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('project_preference_4'))
                      <span id="projectpref4-error" class="error text-danger" for="project_preference_4">{{ $errors->first('project_preference_4') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Project 5') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12" name="project_preference_5" id="projectpref5" required>
                      <option hidden value="0">Select your fifth project preference</option>
                      @foreach($projects as $project)
                        <option value="{{$project->id}}" {{old('projectpref5') == $project->id ? 'selected' : ''  }}>{{$project->projectname}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('project_preference_5'))
                      <span id="projectpref5-error" class="error text-danger" for="project_preference_5">{{ $errors->first('project_preference_5') }}</span>
                    @endif
                  </div>
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
<!-- <script type="text/javascript">
  
function GetSelectedValues(value)
{
  var val;
  val.push(value);
  alert(val)
  let _token   = $('meta[name="csrf-token"]').attr('content');
  if(date != ' ')
  {
      $.ajax({
        type    : 'POST',
        url     : '/gettimeslot',
        data    : { _token: _token, date: date, panel: panel},
        dataType: 'json',
      }).done(function (data) {
        $('#timeslot').empty();
       $('#timeslot').append($('<option>').text('--Select timeslot--').attr( {'value': '', 'selected': true} ) );
        for(var i = 0; i < data.length; i++)
        {
          $('#timeslot').append($('<option>').text(data[i]).attr('value', data[i]));
        }

      }).fail(function () {
          alert('Sorry, No Slots available.');
      });
  }
}
</script> -->