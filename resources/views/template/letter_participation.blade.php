<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Certificate</title>
    <style>
    @page
    { 
        margin: 0px;
    } 
    body 
    { 
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
    <img src="{{asset('img/letter_head_2.png')}}" name="image02.png" width="760px" Height="140px" style=" margin-top: .2in; margin-left:.1in;" />

    <div class= 'layout-middle'>
    <p style="font-family:Optima; text-align: center; font-size:22pt;">{!! $cert_template->title !!}</p>
    </div>
    <div class= 'layout-body' style=" height:300px; margin-right:0.5in;font-family:Optima; font-size:14pt; line-height:150%;margin-left:0.7in;"><p style=" text-align:justify;">@yield('content')</p></div>
    <div class= "panel" style="margin-right:.5in;margin-top:2in; float:right;">
    <img alt="QR-code"src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(130)->generate(url('validate/'.$hash))) }}" />   
    <div style="font-face:'Arial'; font-size:5pt;margin-top:0px">{{ $hash }}</div>
    </div>
    <div id="signature" style="margin-left:0.6in;">
    <img src="{{asset('img/sign.png')}}" name="image02.png" width="100" Height="70" border="0" style="margin-left:0.2in;" />
    <p style="font-face:'Arial';font-size:'11';margin-top:0.6px;">
    ________________<br>
    Prof. Kavi Arya <br />
    Principal Investigator, e-Yantra<br />
    Professor<br />
    Department of Computer Science and Engineering<br />
    Indian Institute of Technology Bombay<br/>
    </p>
    </div>
    <div id="footer" style="margin-left:0.6in;">
    _________________________________________________________________________________
    
    <span style="font-family:'Arial';display:block;font-size:.80em;font-weight:bold;">e-Yantra is a project sponsored by MHRD, Government of India, under the National Mission on Education through <br/>ICT (NMEICT).</span>
    <span style="font-family:'Arial';display:block;font-size:.80em;">
    <strong>Certificate of Merit:</strong> awarded to the student for outstanding performance in the course<br/>
    <strong>Certificate of Completion:</strong> awarded to the student for completing all the tasks in the course<br/>
    <strong>Certificate of Participation:</strong> awarded to the student for partial completion of tasks in the course<br/>
    </span> 
    </div>
</page></body></html>

