@extends('layouts.app', ['activePage' => 'InterviewResult', 'titlePage' => __('Interview Result')])

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

      <div class="row center-cols center-align">
          <div class="card-header card-header-primary">
            <h4 class="card-title"><b>Total Students to be Interviewed: {{ count($user_data) }}</b></h4>
          </div>
      </div>

      <div class="col-sm-4">
          <div class="row center-cols center-align">
            <div class="col m4">
              @foreach($user_data as $stud)
                <div class="card">
                  <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ $stud->name }}</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <label class="col-form-label"><b>{{ __('Interview Date:') }}   {{ $stud->date }}</b></label>
                    </div>
                    <div class="row">
                      <label class="col-form-label"><b>{{ __('Time slot Booked:') }}   {{ $stud->availableslots }}</b></label>
                    </div>
                    <div class="row">
                      <a href="/ViewMyRegistration/{{Crypt::encrypt($stud->userid)}}" target="_blank" class="col-sm-4 col-form-label"><b>{{ __('See Details') }}</b></a>

                      <a href="/EvaluationResult" target="_blank" class="col-sm-4 col-form-label"><b>{{ __('Evaluate') }}</b></a>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
      </div> 

    </div>
  </div>

@endsection
