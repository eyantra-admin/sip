@extends('layouts.app', ['activePage' => 'View_profiles', 'titlePage' => __('Evaluation By Mentor')])

@section('content')   
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
      <div class="row my-4">
        <div class="col-sm-2"></div>
        <div class="col-sm-7">
          <div class="p-2" style="background-color:#ADD8E6;">
            <p>Student Details:</p>
              <ul style="list-style-type: decimal;">
                  <li>Name: <b>{{$student->name}}</b></li>
                  <li>Interviewed By: <b>Panel {{$student->panelid}}</b></li>
              </ul>
            </div>  
          </div>                    
      </div>

      @if($preferences != null)
      <div class="row my-4">
        <div class="col-sm-2"></div>
        <div class="col-sm-7">
          <div class="p-2" style="background-color:#ffcdd2;">
            <p>Students Project Preferences:</p>
            <ul style="list-style-type: decimal;">
              <li>
                <a href="../mentorprojectdetail/{{Crypt::encrypt($preferences->p1_id)}}" target="_blank"> {{$preferences->p1_name}}
                </a>
              </li>
              <li>
                <a href="../mentorprojectdetail/{{Crypt::encrypt($preferences->p2_id)}}" target="_blank">
                  {{$preferences->p2_name}}
                </a>
              </li>
              <li>
                <a href="../mentorprojectdetail/{{Crypt::encrypt($preferences->p3_id)}}" target="_blank">
                  {{$preferences->p3_name}}
                </a>
              </li>
              <li>
                <a href="../mentorprojectdetail/{{Crypt::encrypt($preferences->p4_id)}}" target="_blank">
                  {{$preferences->p4_name}}
                </a>
              </li>
              <li>
                <a href="../mentorprojectdetail/{{Crypt::encrypt($preferences->p5_id)}}" target="_blank">
                  {{$preferences->p5_name}}</a>
                </li>
              </ul>
            </div>  
          </div>                    
      </div>
      @endif

      @if($panel_eval != null)
      <div class="row my-4">
        <div class="col-sm-2"></div>
        <div class="col-sm-7 p-2" style="background-color:#90EE90;">
          <p><b>Panel Decision:</b></p>
          <p>(If you want to edit/update, Please fill it again and save)</p>
          Project Preferences decided by Panel:
          <ul style="list-style-type: decimal;">
            <li>{{$panel_eval->p1_name}}</li>
            <li>{{$panel_eval->p2_name}}</li>
            <li>{{$panel_eval->p3_name}}</li>
          </ul>
          <ul style="list-style-type: circle;">
            <li><b>Decision:</b> {{$panel_eval->decision}}</li>
            <li><b>Technical Strenth:</b> {{$panel_eval->technicalstrength}}</li>                     
            <li><b>Willingness for Outside Projects:</b> {{$panel_eval->outside_prj_willingness}}</li>
            <li><b>Exam Schedule Clash:</b> {{$panel_eval->exam_schedule_clash}}</li>
          </ul>
          <p class="mx-4">{{$panel_eval->remark}}</p>
        </div>                    
      </div>
      @endif

      
    </div> 
    </div>
  </div>
@endsection