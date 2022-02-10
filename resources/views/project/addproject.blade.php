@extends('layouts.app', ['activePage' => 'addproject', 'titlePage' => __('Add Project')])

@section('content') 
  <div class="content">
    <div class="container-fluid">

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

      <!-- ------Add project table------- -->
      
      <div class="col-md-12">
        <form method="post" action="{{ route('insertproject') }}" autocomplete="off" class="form-horizontal">
          @csrf


          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Add Project') }}</h4>
              <p class="card-category">{{ __('Add project that you will be mentoring along with its brief abstract and technology stack.') }}</p>
            </div>
            <div class="card-body">
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Project Name') }}</label>
                <div class="col-sm-7">
                  <input class="form-control" type="text" name="projectname" id="projectname" placeholder="Project Name" value="{{old('model')}}" required>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Project Abstract') }}</label>
                <div class="col-sm-7">
                  <textarea class="form-control" name="projectabstract" id="projectabstract" required 
                        placeholder="Add Project Abstract" value="{{old('projectabstract')}}" rows="4" wrap="physical"></textarea>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Technology Stack') }}</label>
                <div class="col-sm-7">
                  <input class="form-control" type="text" name="technologystack" id="technologystack" placeholder="Technology Stack" value="{{old('model')}}" required>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>
              </div>
            </div>
          </div>
        </form>

        <form method="post" action="{{ route('project.savementorproject') }}" autocomplete="off" class="form-horizontal">
          @csrf
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Mentor - Project Allocation') }}</h4>
              <p class="card-category">{{ __('Assign mentors to a project.  You can assign maximum of 3 mentors') }}</p>
            </div>
            <div class="card-body">
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Project Name') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12 form-control" name="project" id="project" required>
                      <option hidden value="">Select your project</option>
                      @foreach($projects as $project)
                        <option value="{{$project->id}}" {{old('project') == $project->id ? 'selected' : ''  }}>{{$project->projectname}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('projectt'))
                      <span id="project-error" class="error text-danger" for="project">{{ $errors->first('project') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Mentor 1') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12 form-control" name="mentor1" id="mentor1" required>
                      <option hidden value="0">Select Mentor 1</option>
                      @foreach($mentors as $mentor1)
                        <option value="{{$mentor1->id}}" {{old('mentor1') == $mentor1->id ? 'selected' : ''  }}>{{$mentor1->mentorname}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('mentor'))
                      <span id="mentor1-error" class="error text-danger" for="mentor1">{{ $errors->first('mentor1') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Mentor 2') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12 form-control" name="mentor2" id="mentor2">
                      <option hidden value="0">Select Mentor 2</option>
                      @foreach($mentors as $mentor2)
                        <option value="{{$mentor2->id}}" {{old('mentor2') == $mentor2->id ? 'selected' : ''  }}>{{$mentor2->mentorname}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('mentor2'))
                      <span id="mentor2-error" class="error text-danger" for="mentor2">{{ $errors->first('mentor2') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Mentor 3') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12 form-control" name="mentor3" id="mentor3">
                      <option hidden value="0">Select Mentor 3</option>
                      @foreach($mentors as $mentor3)
                        <option value="{{$mentor3->id}}" {{old('mentor3') == $mentor3->id ? 'selected' : ''  }}>{{$mentor3->mentorname}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('projectt'))
                      <span id="mentor3-error" class="error text-danger" for="mentor3">{{ $errors->first('mentor3') }}</span>
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
