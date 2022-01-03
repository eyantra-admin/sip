@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content') 
  <div class="content">
    <div class="container-fluid">
      <div class="col-md-12" style="margin-top: 100px">
          <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('e-Yantra Summer Internship') }}</h4>
            </div>
            <div class="card-body">
              <h3><b>Registration closed</b></h3>
            </div>
          </div>
      </div> 
    </div>
  </div>
@endsection
