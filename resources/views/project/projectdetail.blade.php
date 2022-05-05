@extends('layouts.app', ['activePage' => 'preference', 'titlePage' => __('Project detail')])

@section('content') 
  <div class="content">
    <div class="container-fluid">
      <div class="card card-nav-tabs">
        <div class="card-header card-header-primary">
         <h3> <b>Project: {!!$projectdtl->projectname!!} </b></h3>
        </div>

        <div class="card-body">
          <div class="row">
          <div class="tim-typo">
          </div>

          <div class="tim-typo">
            <h3><b>Project Abstract</b></h3>
            <blockquote class="blockquote">
              <pre>
                {!!$projectdtl->abstract!!}
              </pre>
            </blockquote>
          </div>

          <!-- <div class="tim-typo">
            <h3><b>Technology Stack</b></h3>
            <blockquote class="blockquote">
              <small>
                {!!$projectdtl->technologystack!!}
              </small>
            </blockquote>
          </div> -->
         </div>
        </div>
      </div>
      <!-- Technology stack card -->
      <div class="card">
         <!--  <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('The projects you prefered') }}</h4>
          </div> -->
          <div class="card-body">
           <h3><b>Technology Stack</b></h3><br>
           <blockquote class="blockquote">
              <small>
                {!!$projectdtl->technologystack!!}
              </small>
            </blockquote>
          
          </div>
        </div>
    </div>
  </div>

 
@endsection