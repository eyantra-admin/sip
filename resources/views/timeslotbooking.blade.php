@extends('layouts.app', ['activePage' => 'timeslotbooking', 'titlePage' => __('Time Slot Booking')])

@section('content') 
  <div class="content">
    <div class="container-fluid">
      <div class="col-md-12" style="margin-top: 100px">
        <form method="post" action="{{ route('booktimeslot') }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('put')

          @if($errors->any())
          <div class="alert alert-danger" role='alert'>
          @foreach($errors->all() as $error)
          <p>{!!$error!!}</p>
          @endforeach
          </div>
          <hr/>
          @endif
          <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Pannel Allocation') }}</h4>
                
            </div>
            <div class="card-body">
              <h3><b>You have been allocated to Panel No- {{$panel}}</b></h3>
            </div>
          </div>
<br>
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Time Slot Booking') }}</h4>
              <p class="card-category">{{ __('Select your preferred timeslot for the interview.') }}</p>
            </div>
            <div class="card-body">
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

               <h3><b>Please ensure about your availability on the date and time you wish to book the slot. <br>No change is the timeslot is permitted.</b></h3> <br>
              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Date') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12" name="date" id="date" required onchange="GetTimeSlots(this.value)">
                      <option hidden value="">Select Date</option>
                      @foreach($dates as $date)
                        <option value="{{$date->date}}" {{old('date') == $date->date ? 'selected' : ''  }}>{{$date->date}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('date'))
                      <span id="date-error" class="error text-danger" for="date">{{ $errors->first('date') }}</span>
                    @endif
                  </div>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-2 col-form-label">{{ __('Timeslot') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12" name="timeslot" id="timeslot" required>
                      <option hidden value="">Select TimeSlot</option>
                    </select>
                    @if ($errors->has('timeslot'))
                      <span id="timeslot-error" class="error text-danger" for="timeslot">{{ $errors->first('timeslot') }}</span>
                    @endif
                  </div>
                </div>
              </div>

              <center>
                <div class="card-footer ml-auto mr-auto">
                <button type="submit" value="submit" class="btn btn-primary" style=" margin-left: 500px">{{ __('Save') }}</button>
              </div>
              </center>
              
            </div>
          </div>
        </form>
      </div> 
    </div>
  </div>
@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">

function showtimeslots(){
  document.getElementById('timeslot').style.display = 'block';
}


function GetTimeSlots(date,panel)
{
  var panel = {{$panel}};
  let _token   = $('meta[name="csrf-token"]').attr('content');
  if(date != ' ')
  {
      $.ajax({
        type    : 'POST',
        url     : '/gettimeslot',
        data    : { _token: _token, date: date, panel: panel},
        dataType: 'json',
      }).done(function (data) {
        $('#timeslot').empty();
       $('#timeslot').append($('<option>').text('--Select timeslot--').attr( {'value': '', 'selected': true} ) );
        for(var i = 0; i < data.length; i++)
        {
          $('#timeslot').append($('<option>').text(data[i]).attr('value', data[i]));
        }

      }).fail(function () {
          alert('Sorry, No Slots available.');
      });
  }
}
</script>