<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Certificate</title>
	<style>
	@page
	{ 
		margin: 0px; }
	body { 
		margin: 0px; 
  		background: rgb(204,204,204); 
	}
	page[size="A4"] {
	  background: white;
	  width: 21cm;
	  height: 29.7cm;
	  display: block;
	  margin: 0 auto;
	}
	.img2 {
		position:absolute;
		
		width:118px;
		height:1085px;
/*		width:100%;
		display:flex;
		justify-content:left;*/
	}
	table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
	</style>
</head>
<body>
<page size="A4">

    <img src="{{asset('img/sidepanel.png')}}"  name="image03.png" style="float:left;position:absolute"vspace="5"  hspace="5" z-index= -1 width="118" height="1085" border="0" / >
	
	<div class= 'layout-top' style="font-family:Optima, serif;padding-left:.5cm;">
		<p style="font-size=18;">ERTS Lab<br />
		Department of Computer Science and Engineering<br />
		Indian Institute of Technology Bombay,<br />
		Powai, Mumbai-400 076.<br />
    	</p>
    </div>
    <img src="{{asset('img/ring.png')}}" name="image02.png" widht="259" Height="246" border="0" style="position: absolute;width: 259px;margin-left:1.6in; margin-bottom:0.5in;" />

    <div class= 'layout-middle' style="position:absolute; margin-top:2.4in;margin-left:.3in;">
    	@if($student_details->proj_duration != NULL)
    	<span style="font-family:Optima; font-size:12pt; float: right; padding-right:1cm; padding-top:.5cm; padding-bottom:.5cm;" >
    	Date of Issue: {{$cert_template->issue_date}}
    	</span><br><br>
    	@endif
		<p style="font-family:Optima; font-size:21pt;">{!! $cert_template->title !!}
		</p>
	</div>
	<br><br><br>

	<div class= 'layout-body' style="height:200px;margin-top:2.8in;margin-right:0.5in; margin-bottom:2in; margin-left:.3in;font-family:Optima;font-size:12pt;line-height:130%;">
		<p style=" text-align:;">
		@yield('content')
		</p>
	</div>

	<div class= "panel" style="margin-right:.5in; float:right;">
    <img alt="QR-code"src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(130)->generate(url('validate/'.$hash))) }}" />	
    <div style="font-face:'Arial'; font-size:5pt;margin-top:0px">{{ $hash }}</div>
    </div>
    <img src="{{asset('img/sign.png')}}" name="image02.png" width="100" Height="70" border="0" style="margin-left:.2in;" />
   	<div id="signature" style="margin-left:.1in;">
	<p style="font-face:'Arial';font-size:'11';margin-top:0.9px;">
	________________<br>
	Prof. Kavi Arya <br />
	Principal Investigator, e-Yantra<br />
	Professor<br />
	Department of Computer Science and Engineering<br />
	Indian Institute of Technology Bombay<br/>
	</p>
	</div>
	<div id="footer" style="margin-left:.1in;">
	_________________________________________________________________________________
	<span style="font-family:'Arial';display:block;font-size:.80em;font-weight:bold;">e-Yantra is a project sponsored by MHRD, Government of India, under the National Mission on Education through ICT (NMEICT).</span>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

</page>
<page size="A4">
	
   <img src="{{asset('img/sidepanel.png')}}"  name="image03.png" class="img2" vspace="5">

    <div style="position:absolute; left:160px; margin-top:1in; padding-left: 2px; padding-right: 50px">
		<p style="font-family:Optima; font-size:21pt;">Skill-set

		</p>
		<div style= "padding-left: 2px; padding-right: 50px; text-align: justify;">
		{!! $certi_details->back_content !!}
		<br><br><br>
		
		</div>
	</div>

</page>
</body>
</html>
