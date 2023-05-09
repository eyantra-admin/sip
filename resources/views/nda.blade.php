@extends('layouts.app', ['activePage' => 'nda', 'titlePage' => __('NDA')])

@section('content') 
  <div class="content">
    <div class="container-fluid">
       @if($errors->any())
      <div class="alert alert-danger" role='alert'>
      @foreach($errors->all() as $error)
      <p>{!!$error!!}</p>
      @endforeach
      </div>
      <hr/>
      @endif

      @if (session('status'))
        <div class="row">
          <div class="col-sm-12">
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
              </button>
              <span>{{ session('status') }}</span>
            </div>
          </div>
        </div>
      @endif

      <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('eYSIP - Non Disclosure Agreement ') }}</h4>
            (to be signed by the intern, participating in the e-Yantra Summer Internship Program [eYSIP])
        </div>
        <div class="card-body">
          <h4><b>
            I, <b>{{Auth::user()->name}}</b> participating in the e-Yantra Summer Internship Program (eYSIP) conducted by the e-Yantra project of IIT Bombay, <br><br>

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
          </b></h4>
          <div style="background-color: #f1cbf7; border-radius: 5px; margin: 50px">
            <center>
              <h3><b>You are required to upload your Photograph, Digital signature and Pancard/Aadhar card.<br>
                  Format: JPEG / PNG / JPG<br/>
                  Size: < 1MB
              </b></h3>
             </center>
            <br>
            <div style="margin-left: 25px; margin-bottom: 25px;">
            <form method="post" action="{{ route('submitnda') }}" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">
               @csrf
            @method('put')
                  
                <h4><b>Upload Photograph</b></h4>
                <input type="file" name="photo" id="photo" required />
                <br><br>
                <h4><b>Upload Digital Signature</b></h4>
                <input type="file" name="signature" id="signature" required />
                <br><br>
                <h4><b>Upload Pancard/Aadhar Card</b></h4>
                <input type="file" name="pancard" id="pancard" required />
                <br><br>
                <h4>
                <input name="conduct" value="1" type="checkbox" required />
                I have read the above NDA agreement and <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">Declaration Document</button> carefully and accept that this is a legally valid and binding obligation and hereby agree to the above content.
                </h4>
          <br/><br/>
            </div>
            <div class="card-footer ml-auto mr-auto">
              <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Submit') }}</button>
            </div>
            </form>
           
          </div>
        
        </div>
      </div>

     
     
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">eYSIP Declaration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="font-size: 9pt;">
        I, <b>{{Auth::user()->name}}</b> participating in the e-Yantra Summer Internship Program (eYSIP) conducted by the e-Yantra project of IIT Bombay,<br><br>

            <ol>
              <li>
            Declare that all documents and work products submitted by me are my original work. Wherever I have consulted other sources, I have provided appropriate references.</li>
             <li>Shall not speak with the media or other agencies or in any public forum regarding my project that I will submit to e-Yantra.</li>
             <li>Understand that if required to disclose or display the working of the project that was submitted for e-Yantra in any public forum, I may do so ONLY after PRIOR approval of e-Yantra, IIT Bombay.</li>
             <li>Understand that any and all data, information, related to the project disclosed or furnished by or on behalf of e-Yantra is the sole and absolute property of e-Yantra, IIT Bombay.</li>
             <li>Understand that, NO material, data or information is to be copied/replicated/reproduced or stored without written permission of e-Yantra, IIT Bombay and the contents thereof must not be imparted/disseminated or disclosed for any unauthorized purpose and/or usage or any other reason whatsoever on any version control platforms like GitHub, Bitbucket etc.</li>
             <li>Understand that Indian Institute of Technology Bombay and e-Yantra shall own all the code and content which is created during eYSIP or as a result thereof.</li>
             <li>Understand that logos of e-Yantra and IIT Bombay shall not be used/utilized for/in any promotional or other event/activity by the student. Any use of the e-Yantra name/logo in any manner whatsoever needs prior written approval from the e-Yantra project, IIT Bombay.</li>
             <li>Understand that I am not allowed to claim employment with e-Yantra or IIT Bombay on online social media platforms such as Facebook, LinkedIn etc without prior approval from e-Yantra. I am, however, allowed to claim association with e-Yantra as an e-YSIP Intern between the time frame of June 2023 - July 2023. </li>
             <li>Understand that eYSIP is a full-time commitment and I need to put in at least 40 hours of work per week. I also understand that I am not allowed to participate in any other internship/job while being an active eYSIP intern.</li>
             <li>Understand that I am not eligible for a ‘Letter of Recommendation’ from any of the e-Yantra team members</li>
             <li>Understand that copyright of work products that arise out of my/our work for the project will be held by and shall vest in e-Yantra, IIT Bombay.</li>
             <li>Understand that all data, forms, feedbacks, etc. I partake during the competition can be used for research and educational purposes by e-Yantra, IIT Bombay.</li>
             <li>Any publication arising from the work under eYSIP shall be duly acknowledged in a form and manner to the satisfaction of e-Yantra team, IIT Bombay and only submitted for publication after taking due written permission.</li>
             <li>Accept that I must be available in Mumbai to work in e-Yantra Lab at IITB campus for the duration of the internship.</li>
             <li>Will not hold e-Yantra IITB responsible in case of any mishaps, injury or loss of property during the period of internship.</li>
           </ol>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-145861739-15"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-145861739-15');
</script>
