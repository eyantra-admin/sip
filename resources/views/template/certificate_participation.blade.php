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
    <img src="{{asset('img/ring.png')}}" name="image02.png" widht="259" Height="246" border="0" style="margin-top: .3in; position:relative ;width: 259px;" />

    <div class= 'layout-middle' style="position:relative;margin-top: .2in; font-family:Optima; font-size:21pt;">
{!! $cert_template->title !!}
	</div>

	<div class= 'layout-body' style="margin-right:0.6in; margin-bottom:2.4in;font-family:Optima;font-size:12pt;line-height:130%;">
	
		@yield('content')

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
		<p style="font-family:Optima; font-size:21pt;">Intern Evaluation

		</p>
		<div style= "padding-left: 2px; padding-right: 50px; text-align:justify;">
			<p>{!! $student_details->cert_back_content !!}</p> 
		<br><br><br>
		
		<!-- <table>
		  <tr>
		    <th>Criteria</th>
		    <th style="text-align: center;">Rating</th>
		  </tr>
		  <tr>
		    <td>Intern's understanding of technical concepts<br> pertaining to Project</td>
		    <td style="text-align: center;">{!! $certi_details->rating1 !!} </td>
		</tr>
		<tr>
		    <td>Quality of Solution Provided</td>
		    <td style="text-align: center;">{!! $certi_details->rating2 !!} </td>
		</tr>
		<tr>
		    <td>Attitude</td>
		    <td style="text-align: center;">{!! $certi_details->rating3 !!} </td>
		</tr>
		<tr>
		    <td>Punctuality</td>
		    <td style="text-align: center;">{!! $certi_details->rating4 !!} </td>
		</tr>
		<tr>
		    <td>Capacity to work in Team</td>
		    <td style="text-align: center;">{!! $certi_details->rating5 !!} </td>
		</tr>
		<tr>
		    <td>Documentation Skills</td>
		    <td style="text-align: center;">{!! $certi_details->rating6 !!} </td>
		</tr>
		<tr>
		    <td>Presentation Skills</td>
		    <td style="text-align: center;">{!! $certi_details->rating7 !!} </td>
		</tr>
		<tr>
		    <td><b>Overall</b></td>
		    <td style="text-align: center;"><b>{!! $certi_details->rating8 !!}</b> </td>
		</tr>
		  

		</table> -->
		</div>
	</div>

</page>
</body>
</html>
