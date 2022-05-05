@extends('template.certificate_participation')
@section('content')
<div>
    <p>
    	This certificate is awarded to <b>{{$student_details->name}}</b>, a student of B.Tech from <b>{{$student_details->college}}</b>  who has successfully completed 8 (Eight) weeks (from 3rd January 2022 to 25th of February 2022) long online <b>{{$project_name->projectname}}</b> at e-Yantra, IIT Bombay.
    </p>
</div>
@endsection
