@extends('layouts.app', ['activePage' => 'bank_details', 'titlePage' => __('Bank Details Form')])

@section('content') 
<div class="content">
  <div class="container-fluid">
    <div class="col-md-12">
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
              <h4 class="card-title"><b>{{ __('Submit IITB Vendor ID') }}</b></h4>
              <p>All interns requested to fill your vendor ID</p>
          </div>
          <div class="card-body">
              <div id="test1" class="col s12">
                @if($intern->bank_accountno == null)  
                  <div class="mt-3 text-lg text-justify">
                    <p class="text-red-500 text-lg mt-4 font-bold">If you have already done a IITB vendor registration, Please skip this step.</p>

                    <h4><strong>Vendor Registration:</strong></h4>
                    <p class="mt-2">To transfer your Travel expenses and prize money(if applicable) each member require to create a vendor registration.</p>
                    
                    <p class="mt-2">To ensure the seamless distribution of above, kindly register on the IIT Bombay vendor portal- <a class="text-blue-500" target="_blank" href="https://portal.iitb.ac.in/vrp">https://portal.iitb.ac.in/vrp</a>.</p>
                    
                    <p class="font-bold mt-4">The steps are mentioned below:</p>

                    <ul class="list-decimal ml-8 mt-4">             
                      <li>Visit  <a class="text-blue-500" target="_blank" href="https://portal.iitb.ac.in/vrp">https://portal.iitb.ac.in/vrp</a></li>
                      <li>Select Indian Ext. User / Vendor</li>
                      <li>Enter your PAN and email address</li>
                      <li>In students' and teachers' cases, you may not have GST. In such a case, you should select ‘unregistered.’</li>
                      <li>You will receive an email from the IITB portal. Make sure to fill in all details correctly.</li>
                      <li>
                        Keep scanned copies of the following documents ready-
                        <ul class="list-decimal ml-8">
                          <li>The first page of the passbook / online bank statement / canceled cheque (It should have the bank account number and IFSC), and</li> 
                          <li>PAN Card</li>
                        </ul>             
                      </li>
                      <li>
                        After submitting the details, you will receive a BREG Form. The following signatures will be required on this form-
                        <ul class="list-decimal ml-8">
                          <li>You as a Vendor.</li>
                          <li>Your Bank Officer.</li> 
                          <li>Your Bank Stamp (if you show the form to the Bank, they will know where to sign it).</li>
                        </ul>
                        <p class="mt-2 bg-red-200 px-4 py-2 rounded-md text-md"><b>Note:</b> BREG Form number is not your vendor id, After BREG from submission you will receive a vendor id from IITB</p>                
                      </li>
                      <li>Send the scanned copies of the documents to <mail>helpdesk.mdm@iitb.ac.in</mail> to complete registration.</li>        
                    </ul>                    
                </div>
                <hr>                
                <form method="post" action="{{ route('savebank_details') }}" autocomplete="off" class="form-horizontal">
                  @csrf            

                  <!-- vendor id-->
                  <div class="row">
                    <p class="col-sm-12 col-lg-12">Once you get your vendor ID, Please fill the following details:</p>
                    <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold;">{{ __('Vendor ID') }}<span style="color:red;">*</span></label>
                    <div class="col-sm-3">
                      <div class="input-field {{ $errors->has('vendorID') ? ' has-danger' : '' }}">
                        <input class="form-control" type="text" name="vendorId" id="vendorId" placeholder="Your IITB VendorId" value="{{ old('vendorId') }}" required>
                        @if ($errors->has('vendorId'))
                          <span id="vendorId-error" class="error text-danger" for="vendorId">
                            {{ $errors->first('vendorId') }}
                          </span>
                        @endif
                      </div>
                    </div>
                  </div>                 
                  <div class="card-footer ml-auto mr-auto">                      
                    <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>
                  </div>  
                </form>
                @else
                  <p>Your Vendor Id is: {{$intern->bank_accountno}}</p>
                @endif
              </div>
          </div>    
        </div>
    </div>
  </div>
</div>    
@endsection

@push('js')
<!--Import jQuery before materialize.js-->
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

<script>
  $(document).ready(function(){
    $('.tabs').tabs();

      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      }); 
    });  
</script>

<script type="text/javascript">
  var k=1;
  var click = 1;
  function addmore()
  {
    k++;  
    incrementValue();
      $('#dynamic_field').append('<tr id="row'+k+'" class="dynamic-added"><td><textarea name="expdtl[]" placeholder="Add Experience Description- (600 characters) (Co-Curricular/Extra-Curricular activities)" rows="5" cols="115"></textarea></td><td align="center"><button type="button" name="remove" id="'+k+'" class="btn btn-danger btn_remove">Remove</button></td></tr>');  
  }

  function incrementValue()
  {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
  }

  $('body').on("click", '.add-btn', function() 
  {
    var $copyContent = $("#copy-this-div").clone();
    $copyContent.find('input').val('');
    $('.parent-div').append($copyContent);
    click++;
    if(click>=3)
    {
      document.getElementById("add_project").disabled = true;
    }
  });
</script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-145861739-9');
</script>
<script type="text/javascript">
  function hideeyrc()
  {
    document.getElementById('showeyrc').style.display ='none';
    $("#theme").prop("required", false);
    $("#hardware").prop("required", false);
  }
  function showeyrc()
  {
    document.getElementById('showeyrc').style.display = 'block';
    $("#theme").prop("required", true);
    $("#hardware").prop("required", true);
  }

  function ShowHideDiv1(chkPassport) 
  {
    var dvtopics = document.getElementById("dvtopics");
    dvtopics.style.display = chkPassport.checked ? "block" : "none";
  }
</script>
@endpush



