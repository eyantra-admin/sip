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
      
      <div class="col-md-12" style="margin-top: 100px">
        <form method="post" action="{{ route('project.insertproject') }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('put')

          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Add Project') }}</h4>
              <p class="card-category">{{ __('Add project that you will be mentoring along with its brief abstract and technology stack.  You can mentor maximum of 3 projects') }}</p>
            </div>
            <div class="card-body">
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Project Name') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <input class="form-control" type="text" name="projectname" id="projectname" placeholder="Project Name" value="{{old('model')}}" required>
                    @if ($errors->has('projectname'))
                      <span id="projectpref1-error" class="error text-danger" for="projectname">{{ $errors->first('projectname') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Project Abstract') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <textarea class="form-control" name="projectabstract" id="projectabstract" placeholder="Project Abstract" value="{{old('model')}}" rows="4" wrap="physical" required> </textarea>
                    @if ($errors->has('projectabstract'))
                      <span id="projectpref1-error" class="error text-danger" for="projectabstract">{{ $errors->first('projectabstract') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Technology Stack') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <input class="form-control" type="text" name="technologystack" id="technologystack" placeholder="Technology Stack" value="{{old('model')}}" required>
                    @if ($errors->has('technologystack'))
                      <span id="projectpref1-error" class="error text-danger" for="technologystack">{{ $errors->first('technologystack') }}</span>
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
