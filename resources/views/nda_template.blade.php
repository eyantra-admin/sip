<!DOCTYPE html>
<html>
<head>
	<title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style> 
        * {
  box-sizing: border-box;
}

.column {
  float: left;
  width: 33.33%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}
    </style>
</head>
<body>
<div>
  <div class="header-container">
    <h3 style="text-align: center;">eYSIP {{date("Y")}} - Student NDA</h3>
    <?php $url = Storage::url('app/sip_uploads/') ?>
    <div class="row">
      <div class="column">          
          <img src="{{ URL::asset('storage/sip_uploads/'.$nda_data->photo) }}" height="170" width="130"><br/>
      </div>
      <div class="column">
              Name: {{$user_data->name}}<br/>
              Email ID: {{$user_data->email }}<br/>
             <!--  Project ID: {{$user_data->project_alloted }}<br/> -->
      </div>
    </div>
  </div>
  <div class="content">
            I, <b>{{$user_data->name}}</b> participating in the e-Yantra Summer Internship Program (eYSIP) conducted by the e-Yantra project of IIT Bombay, <br><br>
            <ol>
              <li>
            Declare that all documents and work products submitted by me are my original work. Wherever I have consulted other sources, I have provided appropriate references.</li>
             <li>Shall not speak with the media or other agencies or in any public forum regarding my project that I will submit to e-Yantra.</li>
             <li>Understand that if required to disclose or display the working of the project that was submitted for e-Yantra in any public forum, I may do so ONLY after PRIOR approval of e-Yantra, IIT Bombay.</li>
             <li>Understand that any and all data, information, related to the project disclosed or furnished by or on behalf of e-Yantra is the sole and absolute property of e-Yantra, IIT Bombay.</li>
             <li>Understand that, NO material, data or information is to be copied/replicated/reproduced or stored without written permission of e-Yantra, IIT Bombay and the contents thereof must not be imparted/disseminated or disclosed for any unauthorized purpose and/or usage or any other reason whatsoever on any version control platforms like GitHub, Bitbucket etc.</li>
             <li>Understand that Indian Institute of Technology Bombay and e-Yantra shall own all the code and content which is created during eYSIP or as a result thereof.</li>
             <li>Understand that logos of e-Yantra and IIT Bombay shall not be used/utilized for/in any promotional or other event/activity by the student. Any use of the e-Yantra name/logo in any manner whatsoever needs prior written approval from the e-Yantra project, IIT Bombay.</li>
             <li>Understand that I am not allowed to claim employment with e-Yantra or IIT Bombay on online social media platforms such as Facebook, LinkedIn etc without prior approval from e-Yantra. I am, however, allowed to claim association with e-Yantra as an e-YIP Intern between the time frame of June 2023 - July 2023.</li>
             <li>Understand that eYSIP is a full-time commitment and I need to put in at least 40 hours of work per week. I also understand that I am not allowed to participate in any other internship/job while being an active eYSIP intern.</li>
             <li>Understand that I am not eligible for a ‘Letter of Recommendation’ from any of the e-Yantra team members</li>
             <li>Understand that all data, forms, feedbacks etc. I partake during the internship can be used for research and educational purpose by e-Yantra, IIT Bombay.</li>
             <li>Understand that copyright of work products that arise out of my/our work for the project will be held by and shall vest in e-Yantra, IIT Bombay.</li>
             <li>Any publication arising from the work under eYSIP shall be duly acknowledged in a form and manner to the satisfaction of e-Yantra team, IIT Bombay and only submitted for publication after taking due written permission.</li>
             <li>Accept that I must be available in Mumbai to work in e-Yantra Lab at IITB campus for the duration of the internship.</li>             
             <li>Will not hold e-Yantra IITB responsible in case of any mishaps, injury or loss of property during the period of internship.</li>             
           </ol>
     I have read the above NDA agreement and carefully and accept that this is a legally valid and binding obligation and hereby agree to the above content.<br/><br/>

      Signature of candidate: <br/><br/><br/><br/>
      <div>
          <img src="{{asset('storage/sip_uploads/'.$nda_data->signature)}}" height="120" width="180"/ style="padding-left: 30px;">
          <img src="{{asset('storage/sip_uploads/'.$nda_data->pancard)}}" height="150" width="230"/ style="padding-left: 30px;">
      </div>
  </div>
</div>
</body>
</html>

