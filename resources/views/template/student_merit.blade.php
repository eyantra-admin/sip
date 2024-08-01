@extends('template.certificate_participation')
@section('content')
<div>
    <p>
    	@if({{$student_details->external_proj}} == 0)
        This is to certify that <b>{{$student_details->name}}</b>, student from <b>{{$student_details->college}}</b> has undertaken Internship at <nobr>e-Yantra</nobr>, IIT Bombay working on a project entitled: <b>{{$project_name->projectname}}</b> during the period from <b>{!! $student_details->proj_duration !!}</b> and has successfully completed the same.
        @else
        This is to certify that <b>{{$student_details->name}}</b>, student from <b>{{$student_details->college}}</b> has undertaken Internship at <nobr>e-Yantra</nobr>, IIT Bombay working on a project entitled: <b>{{$project_name->projectname}}</b> during the period from <b>{!! $student_details->proj_duration !!}</b>. This project was successfully completed in collaboration with {{$student_details->external_dept}}.
        @endif
    </p>
</div>
@endsection