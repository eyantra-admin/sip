@extends('template.certificate_participation')
@section('content')
<div>
    <p>
    	This certificate is awarded to <b>{{$student_details->name}}</b>, a student of B.Tech from <b>{{$student_details->college}}</b>  who has successfully completed eight-weeks (from 3rd January 2022 to 25th of February 2022) online <b>Product Design Internship programme</b> at <b>e-Yantra, IIT Bombay</b>.<br><br>
        He/She is a member of the team having the following team member:<br>
        <b>{{$student_details->team_member}}</b><br><br>
        This team implemented and completed the task with the topic name: <b>{{$project_name->projectname}}</b><br>
    </p>
</div>
@endsection
