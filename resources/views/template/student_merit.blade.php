@extends('template.certificate_participation')
@section('content')
<div>
    <p>
    	This is to certify that <b>{{$student_details->name}}</b>, student from <b>{{$student_details->college}}</b>, has undertaken Internship at e-Yantra, IIT Bombay working on a project entitled: <b>{{$project_name->projectname}}</b> during the period from <b>{!! $project_name->proj_duration !!}</b> and has successfully completed the same.
    </p>
</div>
@endsection
