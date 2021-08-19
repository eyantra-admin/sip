@extends('template.certificate_participation')
@section('content')
<div>
    <p>
        This certificate is awarded to <b>{{$team_details->name}}</b>, 
        @if($team_details->pay_category != 2)
        from <b>{{$college_dtls->college_name}} {{$college_dtls->state}}, </b>
    	@endif
    	 for participating in the <b>{{$cert_event->title}}</b>, conducted as a part of MOOC through the <b>{!! $cert_event->initiative !!}</b>.<br/><br/>
    The course covered following skillset: <br/>
    {!! $cert_event->skillset !!}
    </p>
</div>
@endsection
