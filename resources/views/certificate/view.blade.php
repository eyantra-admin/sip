<?php $hash="b73e5961491e1c5c0b20006ed6f28a464602deb7" ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Certificate Generator</title>
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

	</style>
</head>
<body>
<page size="A4">

    <img src="{{asset('img/sidepanel.png')}}"  name="image03.png" style="float:left;position:absolute"vspace="5"  hspace="5" z-index= -1 width="118" height="1085" border="0" / >
	
	<div class= 'layout-top' style="font-family:Optima, serif;padding-left: 3.5cm;">
		<p style="font-size=18;">ERTS Lab<br />
		Department of Computer Science and Engineering<br />
		Indian Institute of Technology Bombay,<br />
		Powai, Mumbai-400 076.<br />
    	</p>
    </div>
  
    <img src="{{asset('img/ring.png')}}" name="image02.png" widht="259" Height="246" border="0" style="position: absolute;width: 259px;margin-left:1.6in; margin-bottom:0.5in;" />

    <div class= 'layout-middle' style="position:absolute; margin-top:2.4in;margin-left:1.4in;">
		<p style="font-family:Optima; font-size:22pt;">{!! $template->title !!}
</p>
	</div>
	<br /><br />

	<div class= 'layout-body' style=" height:420px;margin-top:2.8in;margin-right:0.5in; margin-bottom:0.5in; margin-left:1.4in;font-family:Optima;font-size:14pt;line-height:150%;">
		<p style=" text-align:justify;">
		{!! $template->body !!}
		</p>
	</div>

	<div class= "panel" style="margin-left:6.0in;position:absolute;float:right;">
    <img alt="QR-code"src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(130)->generate(url('validate/'.$hash))) }}" />		
    <div style="font-face:'Arial'; font-size:5pt;margin-top:0px">{{ $hash }}</div>
    </div>
   	<div id="signature" style="margin-left:1.3in;">
	<p style="font-face:'Arial';font-size:'11';margin-top:0px;">
	________________<br>
	Prof. Kavi Arya <br />
	Principal Investigator, e-Yantra,<br />
	Associate Professor<br />
	Computer Science &amp; Engineering Department,<br />
	IIT Bombay.
	</p>
	</div>
	<div id="footer" style="margin-left:1.3in;">
	_________________________________________________________________________________
	<p style="font-face:'Arial';font-size:'11';margin-top:0px;">e-Yantra is a project sponsored by MHRD, Government of India, under the National Mission on Education through ICT (NMEICT).</p>
	</div>
<!--//@include('layout.header')
	//@yield('content')
//@include('layout.session')
	-->
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</page>
</body>
</html>
