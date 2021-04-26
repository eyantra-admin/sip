@extends('layouts.Registration.master')
@section('title', 'SIP students')
@section('style')
<style>
label{
  font-size: 17px;
}

		.tabs{
			background: #2ba0db;
		}

		.ui-tabs{
			border:none;
		}


.required:after {
   color: #e32;
   content: "* ";
  font-size: x-large;
}
body{
  padding-left: 10px;
    background-image: url(../../../img/Registration/image1.jpeg);
    background-size: 3000px 2000px;
    background: rgb(246,126,126);
    background: linear-gradient(90deg, rgba(246,126,126,1) 0%, rgba(218,143,143,0.33) 0%, rgba(168,222,217,0.9906337535014006) 100%);
}
hr {
    display: block;
    margin-top: 0.5em;
    margin-bottom: 0.5em;
    margin-left: auto;
    margin-right: auto;
    border-style: inset;
    border-width: 1px;
}

<meta name="viewport" content="width=device-width, initial-scale=1">
.loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid lightblue;
  border-bottom: 16px solid lightblue;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
table.myFormat tr td { font-size: 13px; }
</style>
@stop
@section('content')


<div class="row">
	<h2 align="center">Students registered for SIP 2021</h2>
	<div class="col-xs-12">

		<table class="table table-bordered myFormat"  id="sip_students">
			<thead class="thead-inverse">
				<tr>
					<th>Sl No</th>
					<th>Name</th>
					<th>Phone</th>
					<th>Email</th>
					<th>College</th>
					<th>Branch</th>
					<th>Year</th>
					
					<th>e-YRC /e-YIC /MOOC</th>
					<th>Theme</th>
				</tr>
			</thead>
			<tbody>
				<?php $i=1; ?>
				@foreach($students as $stu)
				<tr>
					<td>{{ $i }}</td>
					<!-- <td><a href="SipStudent?user={{$stu->userid}}" target="_blank"><font color="#9742ff">{{ $stu->name}}</td> -->
						<td><a href="/SipStudent/{{Crypt::encrypt($stu->userid)}}" target="_blank"><font color="#9742ff">{{ $stu->name}}</font></a></td>
					<td>{{ $stu->phone}}</td>
					<td>{{ $stu->email}}</td>
					<td>{{ $stu->college}}</td>
					<td>{{ $stu->branch}}</td>					
					<td>{{ $stu->year}}</td>

					<td>{{ $stu->eyrc_eyic_participating}}</td>
					<td>{{ $stu->eyrc_theme}}</td>					
				</tr>
				<?php $i+=1; ?>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th>S. No</th>
					<th>Name</th>
					<th>Phone</th>
					<th>Email</th>
					<th>College</th>
					<th>Branch</th>
					<th>Year</th>
					
					<th>e-YRC/ e-YIC/ MOOC</th>
					<th>Theme</th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>

@endsection

@section('userscript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
	
	$(document).ready(function(){
		 $('#sip_students').DataTable();
	});
	
</script>
@stop
