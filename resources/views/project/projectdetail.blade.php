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

          <div style="padding: 20px;">
            <h3><b>Project Abstract</b></h3>
           
              <pre style="font-family: Roboto; font-size: 14px; white-space: pre-wrap;">{!!$projectdtl->abstract!!}
              </pre>
         
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

        @if(Auth::user()->role == 2 || Auth::user()->role == 3)
          <div class="row">
              @if($p1_list != null && count($p1_list) >= 1)
                 <div class="col-xs-6 col-md-4 card p-2">
                    <p>Panel's Preference 1 Students</p>
                    <ul>
                        @foreach ($p1_list as $student)
                          <li>
                            <a href="{!!route('EvaluationResult', $student->id)!!}">{{$student->name}}</a>
                            @if($student->decision === 'Yes')
                              <span class="badge bg-success">{{$student->decision}}</span>
                            @endif  
                            @if($student->decision === 'No')
                              <span class="badge bg-danger">{{$student->decision}}</span>
                            @endif
                            @if($student->decision === 'May Be')
                              <span class="badge bg-info">{{$student->decision}}</span>
                            @endif
                          </li>
                        @endforeach  
                    </ul>
                 </div>
              @endif 

              @if($p2_list != null && count($p2_list) >= 1)
                 <div class="col-xs-6 col-md-4 card p-2">
                    <p>Panel's Preference 2 Students</p>
                    <ul>
                        @foreach ($p2_list as $student)
                          <li>
                            <a href="{!!route('EvaluationResult', $student->id)!!}">{{$student->name}}</a>
                            @if($student->decision === 'Yes')
                              <span class="badge bg-success">{{$student->decision}}</span>
                            @endif  
                            @if($student->decision === 'No')
                              <span class="badge bg-danger">{{$student->decision}}</span>
                            @endif
                            @if($student->decision === 'May Be')
                              <span class="badge bg-info">{{$student->decision}}</span>
                            @endif
                          </li>
                        @endforeach  
                    </ul>
                 </div>
              @endif

              @if($p3_list != null && count($p3_list) >= 1)
                 <div class="col-xs-6 col-md-4 card p-2">
                    <p>Panel's Preference 3 Students</p>
                    <ul>
                        @foreach ($p3_list as $student)
                          <li>
                            <a href="{!!route('EvaluationResult', $student->id)!!}">{{$student->name}}</a>
                            @if($student->decision === 'Yes')
                              <span class="badge bg-success">{{$student->decision}}</span>
                            @endif  
                            @if($student->decision === 'No')
                              <span class="badge bg-danger">{{$student->decision}}</span>
                            @endif
                            @if($student->decision === 'May Be')
                              <span class="badge bg-info">{{$student->decision}}</span>
                            @endif
                          </li>                  
                        @endforeach  
                    </ul>
                 </div>
              @endif
          </div>    
        @endif  
    </div>
  </div>

 
@endsection