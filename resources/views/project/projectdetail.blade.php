@extends('layouts.app', ['activePage' => 'preference', 'titlePage' => __('Project detail')])

@section('content') 
  <div class="content">
    <div class="container-fluid">
      <div class="card card-nav-tabs">
        <div class="card-header card-header-primary">
         <h4> <p>{!!$projectdtl->projectname!!} </p></h4>
        </div>


              <div class="card-body">
                <div class="row">
                <div class="tim-typo">
                  
                </div>

                <div class="tim-typo">
                  <span class="tim-note">Project Abstract</span>
                  <blockquote class="blockquote">
                    <small>
                      {!!$projectdtl->abstract!!}
                    </small>
                  </blockquote>
                </div>

                <div class="tim-typo">
                  <span class="tim-note">Quote</span>
                  <blockquote class="blockquote">
                    <small>
                      {!!$projectdtl->technologystack!!}
                    </small>
                  </blockquote>
                </div>
               </div>
              </div>
            </div>
          </div>
        </div>

 
@endsection