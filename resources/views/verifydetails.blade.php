@extends('layouts.app', ['activePage' => 'verifydetails', 'titlePage' => __('Verify Details')])
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

      <div class="card card-nav-tabs">
        <div class="card-header card-header-warning">
          <b>Verify Your Details</b>
        </div>
        <div>
          <center>
            <h3><b>
              Please verify the following details as provided by you. <br>
              Please confirm about the correctness of the details by clicking on "I confirm" button.
            </b></h3>
          </center>
          <div style="background-color: #f1cbf7; border-radius: 5px; margin: 50px">
            <!-- <h6><b>
              This name will be printed on the certificate that will be issued on successfull completion of internship
            </b></h6> -->
<br>
            <h3><b>
              <div class="card-header card-header-success">
                <b>Basic Details (Details as they will appear on your certificate)</b>
                </div>

              <p style="margin:20px;">
               <br><br>
                Name: {{$verifydetails[0]->name}} (As it will appear on your certificate)<br>
                Year: {{$verifydetails[0]->year}} <br>
                Discipline: {{$verifydetails[0]->branch}} <br>
                College Name: {{$verifydetails[0]->college}} <br>
                Project Assigned: {{$verifydetails[0]->projectname}} <br><br>
              </p>
                <div class="card-header card-header-success" style="margin:20px;">
                <b>Address (To be used for shipment of your certificate)</b>
                </div>
                <p style="margin:20px;">
                Address Line 1: {{$verifydetails[0]->addressline1}} <br>
                Address Line 2: {{$verifydetails[0]->addressline2}} <br>
                City: {{$verifydetails[0]->city}}<br>
                State: {{$verifydetails[0]->statename}}<br>
                Pincode: {{$verifydetails[0]->pincode}}<br>
                <br>
                </p>

                <div class="card-header card-header-success">
                <b>Bank Details (For Stipend)</b>
                </div>

                <p style="margin:20px;">
                Account No: {{$verifydetails[0]->bank_accountno}} <br>
                Name(As in Bank): {{$verifydetails[0]->name_inbank}} <br>
                Bank Name: {{$verifydetails[0]->bank_name}} <br>
                IFSC: {{$verifydetails[0]->ifsc}} <br>
                Account Type: {{$verifydetails[0]->bank_type}} <br>
                Bank Address: {{$verifydetails[0]->bank_address}} <br>
            </b></h3>
            @if ($verifydetails[0]->Iconfirm != 1)
            <hr>
            <center><h3><b>I confirm all the details mentioned above are correct.</b></h3>
            
               <a href="/AcceptVerify" class="btn btn-primary">I Confirm</a> 
            </center>
            @endif
            @if ($verifydetails[0]->Iconfirm == 1)
            <hr>
            <center><h3 style="color:green"><b>Successfully Verified !!</b></h3></center>
            @endif

          </div>
        </div>
        <p style="margin:20px;">
          
        </p>
        
      </div>
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