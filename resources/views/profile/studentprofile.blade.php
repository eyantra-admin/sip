@extends('layouts.app', ['activePage' => 'studentprofile', 'titlePage' => __('Student Profile')])
<style type="text/css">
  /* Hide all steps by default: */
.card {
  display: none;
}

  /* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

/* Mark the active step: */
.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <!-- Circles which indicates the steps of the form: -->
              <div style="text-align:center;margin-top:40px;">
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
                <span class="step"></span>
              </div>
             <!--  STEP 1 -->
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Student Profile') }}</h4>
                <p class="card-category">{{ __('General Information') }}</p>
              </div>
              <div class="card-body ">
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
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Country') }}</label>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <select class="form-control" id="country" name="country">
                          <option>Select Country</option>
                            @foreach($country as $country)
                              <option value="{{$country->country}}" {{old('country') == $country->country ? 'selected' : ''  }}>{{$country->country}}</option>
                            @endforeach
                      </select>
                    </div>
                  </div>

                  <label class="col-sm-2 col-form-label">{{ __('State') }}</label>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <select class="form-control" id="state" name="state">
                          <option>Select State</option>
                      </select>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('College') }}</label>
                  <div class="col-lg-4">
                      <div class="form-field">
                          <select class="form-control" id="college" name="college" value="{{old('college')}}" required>
                              <option hidden>Select College</option>
                          </select>
                      </div>
                  </div>

                  <label class="col-sm-2 col-form-label">{{ __('Select Type') }}</label>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <select class="form-control" id="collType" name="collType">
                          <option hidden>Select</option>
                          <option value="1" {{old('collType') == 1 ? 'selected': '' }}>Private</option>
                          <option value="2" {{old('collType') == 2 ? 'selected': '' }}>Public</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Select Year') }}</label>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <select class="form-control" id="year" name="year">
                          <option hidden>Select Year</option>
                          <option value="1" {{old('year') == 1 ? 'selected': '' }}>First year</option>
                          <option value="2" {{old('year') == 2 ? 'selected': '' }}>Second year</option>
                          <option value="3" {{old('year') == 3 ? 'selected': '' }}>Third year</option>
                          <option value="4" {{old('year') == 4 ? 'selected': '' }}>Four year</option>
                        </select>
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Select Department') }}</label>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <select class="form-control" id="department" name="department" value="{{old('department')}}">
                          <option hidden></option>
                            @foreach($department as $department)
                              <option value="{{$department->id}}" {{old('department') == $department->id ? 'selected' : ''  }}>{{$department->name}}</option>
                            @endforeach
                      </select>
                    </div>
                  </div>
                </div>




                <!-- <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Phone') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="input-phone" type="phone" placeholder="{{ __('phone') }}" value="{{ old('phone', auth()->user()->phone) }}" required />
                      @if ($errors->has('phone'))
                        <span id="phone-error" class="error text-danger" for="input-phone">{{ $errors->first('phone') }}</span>
                      @endif
                    </div>
                  </div>
                </div> -->

              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
              </div>
            </div>
            <!-- STEP 2 -->
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Project Info') }}</h4>
                <p class="card-category">{{ __('General Information') }}</p>
              </div>
              <div class="card-body ">
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
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Country') }}</label>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <select class="form-control" id="country" name="country">
                          <option>Select Country</option>
                           
                      </select>
                    </div>
                  </div>

                  <label class="col-sm-2 col-form-label">{{ __('State') }}</label>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <select class="form-control" id="state" name="state">
                          <option>Select State</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('College') }}</label>
                  <div class="col-lg-4">
                      <div class="form-field">
                          <select class="form-control" id="college" name="college" value="{{old('college')}}" required>
                              <option hidden>Select College</option>
                          </select>
                      </div>
                  </div>

                  <label class="col-sm-2 col-form-label">{{ __('Select Type') }}</label>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <select class="form-control" id="collType" name="collType">
                          <option hidden>Select</option>
                          <option value="1" {{old('collType') == 1 ? 'selected': '' }}>Private</option>
                          <option value="2" {{old('collType') == 2 ? 'selected': '' }}>Public</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Select Year') }}</label>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <select class="form-control" id="year" name="year">
                          <option hidden>Select Year</option>
                          <option value="1" {{old('year') == 1 ? 'selected': '' }}>First year</option>
                          <option value="2" {{old('year') == 2 ? 'selected': '' }}>Second year</option>
                          <option value="3" {{old('year') == 3 ? 'selected': '' }}>Third year</option>
                          <option value="4" {{old('year') == 4 ? 'selected': '' }}>Four year</option>
                        </select>
                    </div>
                  </div>
                  <label class="col-sm-2 col-form-label">{{ __('Select Department') }}</label>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <select class="form-control" id="department" name="department" value="{{old('department')}}">
                          <option hidden></option>
                            
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
              </div>
            </div>




            <div style="overflow:auto;">
              <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>

  $(document).ready(function(){
    $("#country").change(function(){
    $country = document.getElementById('country').value;
    console.log($country);

    getStateList();
});
 

    function getStateList()
    {
        $('#state').find('option').remove();
        if($('#country').val() != null){

            $.ajax({
                type    : 'POST',
                url     : '{!! route("getCountrywiseStates") !!}',
                data    : {"country"   : $('#country').val(), _token: '{{csrf_token()}}' },
                dataType: 'json',
            }).done(function (data) {
                $('#state').append($('<option>').text('--Select State--').attr( {'value': '', 'selected': true} ) );
                for(var i = 0; i < data.length; i++)
                {
                  $('#state').append($('<option>').text(data[i]).attr('value', data[i]));
                }
            }).fail(function () {
                alert('Sorry, No State Found');
            });
        }//end of if condition
    }//End of getCollege list



//STATE
$("#state").change(function(){
  alert(10);
      getCollegeList();
});//End of func

function getCollegeList()
{
        @if(old('college'))
        var clgId = {!! old('college') !!};        
        @else
        var clgId = 0;      
        @endif

        $('#college').find('option').remove();
        if($('#state').val() != 0){
            $.ajax({
                type    : 'POST',
                url     : '{!! route("getstatewiseColleges") !!}',
                data    : {"state"   : $('#state').val(), _token: '{{csrf_token()}}' },
                dataType: 'json',
            }).done(function (data) {
                $('#college').append($('<option>').text('--Select College--').attr( {'value': '', 'selected': true} ) );
                for(var i = 0; i < data.length; i++)
                {
                  $('#college').append($('<option>').text(data[i].college_name).attr('value', data[i].id));
                }
            }).fail(function () {
                alert('Sorry, No Colleges... Please Add your college');
            });
        }//end of if condition
    }//End of getCollege list
});


var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("card");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("card");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("card");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}





</script>