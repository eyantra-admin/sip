@extends('layouts.app', ['activePage' => 'bank_details', 'titlePage' => __('Bank Details Form')])

@section('content') 
  <div class="content">
    <div class="container-fluid">
      <div class="col-md-12">
        <form method="post" id="sectionForm" action="{{ route('savebank_details') }}" autocomplete="off" class="form-horizontal">
          @csrf
         

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
                <h4 class="card-title"><b>{{ __('Bank Details Form') }}</b></h4>
                <p>All the information is mandatory to be filled</p>
            </div>
            <div class="card-body">
                  <div id="test1" class="col s12">
                    <form method="post" action="{{ route('bank_details') }}" autocomplete="off" 
                      class="form-horizontal">
                      @csrf
                      <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold;">{{ __('Address Line1') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('addressline1') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="addressline1" id="addressline1" placeholder="Address Line1" value="{{ old('addressline1') }}" required>
                            @if ($errors->has('addressline1'))
                              <span id="fullname-error" class="error text-danger" for="addressline1">{{ $errors->first('addressline1') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold;">{{ __('Address Line2') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('addressline2') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="addressline2" id="addressline2" placeholder="Address Line2" value="{{ old('addressline2')}}">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('city') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('city') ? ' has-danger' : '' }}">
                            <input class="form-control" name="city" id="city" placeholder="city" value="{{ old('city')}}" rows="4" wrap="physical" required>
                            @if ($errors->has('email'))
                              <span id="city-error" class="error text-danger" for="email">{{ $errors->first('email') }}</span>
                            @endif
                          </div>
                        </div>

                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('State') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('statename') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="statename" id="statename" placeholder="State" value="{{old('statename')}}" required>
                            @if ($errors->has('statename'))
                              <span id="statename-error" class="error text-danger" for="statename">{{ $errors->first('statename') }}</span>
                            @endif
                          </div>
                        </div>

                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Pin Code') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('pincode') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="pincode" id="pincode" placeholder="Pin Code" value="{{old('pincode')}}" required>
                            @if ($errors->has('pincode'))
                              <span id="pincode-error" class="error text-danger" for="pincode">{{ $errors->first('pincode') }}</span>
                            @endif
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold;">{{ __('Account Holder Name') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('name_inbank') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="name_inbank" id="name_inbank" placeholder="Bank Name" value="{{ old('name_inbank')}}" required>
                            @if ($errors->has('name_inbank'))
                              <span id="fullname-error" class="error text-danger" for="name_inbank">{{ $errors->first('name_inbank') }}</span>
                            @endif
                          </div>
                        </div>

                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Select Account Type') }}</label>
                        <div class="col-sm-3">
                          <select id="bank_type" class="form-control" name="bank_type" required>
                            <option hidden value="">Select Type</option>
                            <option value="Current" {{old('bank_type') == 'Current' ? 'selected': '' }}>Current</option>
                            <option value="Saving" {{old('bank_type') == 'Saving' ? 'selected': '' }}>Saving</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold;">{{ __('Account Number') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('bank_accountno') ? ' has-danger' : '' }}">
                            <input class="form-control" type="numeric" name="bank_accountno" id="bank_accountno" placeholder="Account Number" value="{{ old('bank_accountno')}}" required>
                            @if ($errors->has('bank_accountno'))
                              <span id="bank_accountno-error" class="error text-danger" for="bank_accountno">{{ $errors->first('bank_accountno') }}</span>
                            @endif
                          </div>
                        </div>

                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold;">{{ __('IFSC Code') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('ifsc') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="ifsc" id="ifsc" placeholder="IFSC Code" value="{{ old('ifsc')}}" required>
                            @if ($errors->has('ifsc'))
                              <span id="ifsc-error" class="error text-danger" for="ifsc">{{ $errors->first('ifsc') }}</span>
                            @endif
                          </div>
                        </div>
                       </div>
                       <div class="row">
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold;">{{ __('Bank Name') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('bank_name') ? ' has-danger' : '' }}">
                            <input class="form-control" type="text" name="bank_name" id="bank_name" placeholder="Bank Name" value="{{ old('bank_name')}}" required>
                            @if ($errors->has('bank_name'))
                              <span id="bank_name-error" class="error text-danger" for="bank_name">{{ $errors->first('bank_name') }}</span>
                            @endif
                          </div>
                        </div>
                        </div>
                        <div class="row"> 
                        <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold;">{{ __('Bank Address') }}</label>
                        <div class="col-sm-3">
                          <div class="input-field {{ $errors->has('bank_address') ? ' has-danger' : '' }}">
                            <input class="form-control" type="numeric" name="bank_address" id="bank_address" placeholder="Bank Address" value="{{ old('bank_address')}}" required>
                            @if ($errors->has('bank_address'))
                              <span id="bank_address-error" class="error text-danger" for="bank_address">{{ $errors->first('bank_address') }}</span>
                            @endif
                          </div>
                       </div>
                    </div>  
                       <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>
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



