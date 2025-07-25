@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
<style>
section.timeline-outer {
  width: 80%;
  margin: 0 auto;
}

h1.header {
  font-size: 50px;
  line-height: 70px;
}
/* Timeline */

.timeline {
  border-left: 8px solid #42A5F5;
  border-bottom-right-radius: 2px;
  border-top-right-radius: 2px;
  box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
  color: #333;
  margin: 50px auto;
  letter-spacing: 0.5px;
  position: relative;
  line-height: 1.4em;
  padding: 20px;
  list-style: none;
  text-align: left;
}

.timeline h1,
.timeline h2,
.timeline h3 {
  font-size: 1.4em;
}

.timeline .event {
  border-bottom: 1px solid rgba(160, 160, 160, 0.2);
  padding-bottom: 15px;
  margin-bottom: 20px;
  position: relative;

}

.timeline .event:last-of-type {
  padding-bottom: 0;
  margin-bottom: 0;
  border: none;
}

.timeline .event:before,
.timeline .event:after {
  position: absolute;
  display: block;
  top: 0;
}

.timeline .event:before {
  left: -177.5px;
  color: #212121;
  content: attr(data-date);
  text-align: right;
  /*  font-weight: 100;*/
  
  font-size: 16px;
  min-width: 120px;
}

.timeline .event:after {
  box-shadow: 0 0 0 8px #42A5F5;
  left: -30px;
  background: #212121;
  border-radius: 50%;
  height: 11px;
  width: 11px;
  content: "";
  top: 5px;
}
/**/
/*——————————————
Responsive Stuff
———————————————*/

@media (max-width: 945px) {
  .timeline .event::before {
    left: 0.5px;
    top: 20px;
    min-width: 0;
    font-size: 13px;
  }
  .timeline h3 {
    font-size: 16px;
  }
  .timeline p {
    padding-top: 20px;
  }
  section.lab h3.card-title {
    padding: 5px;
    font-size: 16px
  }
}

@media (max-width: 768px) {
  .timeline .event::before {
    left: 0.5px;
    top: 20px;
    min-width: 0;
    font-size: 13px;
  }
  .timeline .event:nth-child(1)::before,
  .timeline .event:nth-child(3)::before,
  .timeline .event:nth-child(5)::before {
    top: 38px;
  }
  .timeline h3 {
    font-size: 16px;
  }
  .timeline p {
    padding-top: 20px;
  }
}
/*——————————————
others
———————————————*/

a.portfolio-link {
  margin: 0 auto;
  display: block;
  text-align: center;
}
</style>
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
              <center><span>{{ session('status') }}</span></center>
            </div>
          </div>
        </div>
      @endif

      @if (session('error'))
      <div class="row">
        <div class="col-sm-12">
          <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <i class="material-icons">close</i>
            </button>
            <span>{{ session('error') }}</span>
          </div>
        </div>
      </div>
        @endif

      <div class="card card-nav-tabs">
        <div class="card-header card-header-warning">
          <b class="h3">Welcome to e-Yantra Summer Internship Program</b>
        </div>
        
        @if($form_submitted != 1 and Auth::user()->role == 1)
          <div class="card-body">
            <center>
              <h2><b>
                Congratulations !!!<br>
                You have been shortlisted for e-Yantra Summer Internship Program.<br></b>
              </h2>
            
              <h4 class="card-title">
                <b>You are required to submit your complete profile(along with projects you worked on).</b> 
              </h4>
              <br><br>
              
              <p class="card-text" style="color: Red"><b>NOTE:</b> Please note that, the information once filled cannot be changed/modified later. We will proceed with the information you submit here.</p>
              <p>Note: Please be very precise in adding description of the questions asked in the form.</p>
             
              <a href="{!!route('SipRegistration')!!}" class="btn btn-primary" style="width: 200px;">Fill Profile Form</a> 
              <br><br>

              <p>Please check your filled profile details <a href="{!! route('ViewMyRegistration', Crypt::encrypt(Auth::user()->id))!!}" target="_blank" class="">here.</a></p>
            </center>
          </div>          
        @endif 

        @if($form_submitted == 1 and Auth::user()->role == 1)
          <center>
            <div class="card-body">
              <h4 class="card-title"><b>Profile submission done successfully.</b> <br><br>
                <p>To view your registration, click the below button</p>
              </h4>
              <!-- <a href="{!! route('ViewMyRegistration', Crypt::encrypt(Auth::user()->id))!!}" target="_blank" class="btn btn-primary"> -->
              <a href="{!! route('profile.edit')!!}" class="btn btn-primary">
                {{ Auth::user()->name }}
              </a>
            </div>  
          </center>            
        @endif

        
        @if(Auth::user()->role == 2)
          <center>
            <div class="card-body">
              <h2 class="card-title" style = "color: Green"><b> !! Welcome to the Mentor Portal !!</b> 
              <br><br>
              </h2>
            </div>  
          </center>
        @endif
        
        <!-- UNCOMMENT THIS WHEN INTERN IS SELECTED AFTER INTERVIEW -->
        @if(Auth::user()->selected == 1 and Auth::user()->role == 1 )
        <div>
          <center>
            <h2>
              <b>
                Congratulations !!!<br>
                You have been selected for e-Yantra Summer Internship - 2025.
                <br>
              </b>
            </h2>
            <h3 style="color:Red"> <b>Project Name: <a href="projectdetail/{{Crypt::encrypt($project_alloted[0]->id)}}" target="_blank">{{$project_alloted[0]->projectname}}</a></b>

          </center>
          
          <!-- Certificate Download -->
          <div class="col m12 s12 text-center">
            @if(Auth::user()->MentorClearence == 1)
            <div style="background-color: #f1cbf7; border-radius: 5px; margin: 50px">
              <h3><b>Certificate Details</b></h3>
                <div class="divider"></div>
                  <h3 style="color:Red">
                    Hearty Congratulations!!! <br/>
                    on successful completion of eYSIP 2025 project.<br/>
                  </h3>
                  <hr/>
                <span>
                  <a href="{!! route('download_cert') !!}" target="_blank" class="btn btn-primary">Download Certificate</a>
                </span>
            </div>              
            @endif
          </div>
          <!-- End -->

          <!-- Uncomment the div when projects are alloted -->
          <section id="timeline" class="timeline-outer" style="padding:10px">
            <div class="container" id="content" >
              <div class="row">
                <div class="col-lg-12">
                  <h3><b>In order to accept the internship offer, please complete the following steps:</b>
                  </h3>
                  <ul class="timeline">
                    <li class="event" data-date="Fees Payment">
                      @if(Auth::user()->payment_done == 0)
                      <h3 style="color: Red"><b>Internship Fees Payment</b></h3>
                      @else
                      <h3 style="color: Green"><b>Internship Fees Payment</b></h3>
                      @endif
                      <p>
                        You are required to pay the Internship fee of ₹5,000/- Please use the “Internship Fee Payment” tab to do so.
                      </p>
                    </li>
                    
                    <li class="event" data-date="NDA">
                       @if(Auth::user()->nda_done == 0)
                      <h3 style="color: Red"><b>Submit NDA</b></h3>
                      @else
                      <h3 style="color: Green"><b>Submit NDA</b></h3>
                      @endif
                      <p>Please use the NDA Tab to do so.
                      </p>
                    </li>
                    <!-- <li class="event" data-date="LoR">
                       @if(Auth::user()->lor_done == 0)
                      <h3 style="color: Red"><b>LoR (Letter of Recommendation)</b></h3>
                      @else
                      <h3 style="color: Green"><b>LoR (Letter of Recommendation)</b></h3>
                      @endif
                      <p>If your professor has sent an email, please wait for 2-3 days for status to be updated here.</p>
                    </li> -->

                    
                    <!-- <li class="event" data-date="Survey">
                       @if(Auth::user()->survey_done == 0)
                      <h3 style="color: Red"><b>Internship Survey</b></h3>
                      @else
                      <h3 style="color: Green"><b>Internship Survey</b></h3>
                      @endif
                      <p>
                        Please use the Internship Survey Tab to do so.
                      </p>
                    </li> -->

                    
                  </ul>
                </div>
              </div>
            </div>
          </section>
        </div>
        @else
        <!-- <center>
          <h2><b>
            Sorry !!!<br>
            We regret to inform you that you haven't been selected for eYSIP.<br>
            We wish you all the best for future endeavours!
          </b></h2>
        </center> -->
        @endif  

        <!-- for J & K -->
        @if(Auth::user()->role == 4)
        <div class="card-body">
          <p class="h4">We're excited to have you join our team and embark on this learning journey with us. Please complete your payment to confirm your spot and get started. Your prompt action ensures a smooth onboarding process. Thank you, and we look forward to working with you!</p>
        </div>
        @endif
    </div>       
  </div>  
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>

  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-145861739-15"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-145861739-15');
        </script>


@endpush
