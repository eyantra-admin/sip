@extends('layouts.app', ['activePage' => 'preference', 'titlePage' => __('Project Preference')])

@section('content') 
  <!-- <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header card-header-primary">
            <h4 class="card-title">{{ __('Disclaimers') }}</h4>
        </div>
        <div class="card-body">
          <h4><b>1) Please only choose the projects that you feel you are qualified to do. Do not select a project, just because you want to learn a skill/technology stack.<br><br>
            2) Internship Projects are allocated based on a number of factors such as skill level of candidates, number of vacancies in any particular project etc.
          </b></h4>
        </div>
      </div> -->

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

      <div class="col-md-12" style="margin-top: 100px">
        <form method="post" action="{{ route('final_evalSubmit') }}" autocomplete="off" class="form-horizontal">
          @csrf
          @method('put')

          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Final Evalation Parameters') }}</h4>
            </div>
            <div class="card-body">
              <h4><b>Please apply due deligence while evaluating the interns.</b></h4><br>

              <div class="row">
                <label class="col-sm-2 col-form-label" style = "color:#black;font-weight: bold">{{ __('Intern Name') }}</label>
                <div class="col-sm-7">
                  <select class="form-control" name="internname" id="internname" required>
                    <option hidden value="0">Select Intern Name</option>
                      @foreach($interns as $intern)
                        <option value="{{ $intern->id }}">{{ $intern->name }}</option>
                      @endforeach
                  </select>
                </div>
              </div>

              <!-- <div class="row">
                <label class="col-sm-2 col-form-label " style = "color:#black;font-weight: bold">{{ __('Project') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="form-control" name="projectpref1" id="projectpref1" required>
                      <option hidden value="0">Select Project Name</option>
                      @foreach($projects as $project)
                        <option value="{{$project->id}}" {{old('projectpref1') == $project->id ? 'selected' : ''  }}>{{$project->projectname}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div> -->

              <div class="row">
                <label class="col-sm-2 col-form-label " style = "color:#black;font-weight: bold">{{ __('Project') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="form-control" name="projectpref1" id="projectpref1" required>
                      <option hidden value="0">Select Project Name</option>                        
                    </select>
                  </div>
                </div>
              </div>

              <!-- <div class="row" style = "color:#8742f5;font-weight: bold"> -->
                        <br><h4 style = "color:#8742f5"><b> Please rate the intern on the following terms from 1(lowest) to 10(highest).</b> </h4>
                 <!-- </div> -->

              <div class="row">
                <label class="col-sm-5 col-form-label" style = "color:#black;font-weight: bold">{{ __('Understanding of technical concepts pertaining to Project') }}</label>
                <div class="col-sm-4">
                    <select class="form-control" name="tech_skill" id="tech_skill" required>
                      <option hidden value="0">Rate here</option>
                        <option value="1" style="text-align:center;">1</option>
                        <option value="2" style="text-align:center;">2</option>
                        <option value="3" style="text-align:center;">3</option>
                        <option value="4" style="text-align:center;">4</option>
                        <option value="5" style="text-align:center;">5</option>
                        <option value="6" style="text-align:center;">6</option>
                        <option value="7" style="text-align:center;">7</option>
                        <option value="8" style="text-align:center;">8</option>
                        <option value="9" style="text-align:center;">9</option>
                        <option value="10" style="text-align:center;">10</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-5 col-form-label" style = "color:#black;font-weight: bold">{{ __('Quality of Solution Provided') }}</label>
                <div class="col-sm-4">
                    <select class="form-control" name="quality" id="quality" required>
                      <option hidden value="0">Rate here</option>
                        <option value="1" style="text-align:center;">1</option>
                        <option value="2" style="text-align:center;">2</option>
                        <option value="3" style="text-align:center;">3</option>
                        <option value="4" style="text-align:center;">4</option>
                        <option value="5" style="text-align:center;">5</option>
                        <option value="6" style="text-align:center;">6</option>
                        <option value="7" style="text-align:center;">7</option>
                        <option value="8" style="text-align:center;">8</option>
                        <option value="9" style="text-align:center;">9</option>
                        <option value="10" style="text-align:center;">10</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-5 col-form-label" style = "color:#black;font-weight: bold">{{ __('Attitude') }}</label>
                <div class="col-sm-4">
                    <select class="form-control" name="attitude" id="attitude" required>
                      <option hidden value="0">Rate here</option>
                        <option value="1" style="text-align:center;">1</option>
                        <option value="2" style="text-align:center;">2</option>
                        <option value="3" style="text-align:center;">3</option>
                        <option value="4" style="text-align:center;">4</option>
                        <option value="5" style="text-align:center;">5</option>
                        <option value="6" style="text-align:center;">6</option>
                        <option value="7" style="text-align:center;">7</option>
                        <option value="8" style="text-align:center;">8</option>
                        <option value="9" style="text-align:center;">9</option>
                        <option value="10" style="text-align:center;">10</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-5 col-form-label" style = "color:#black;font-weight: bold">{{ __('Punctuality') }}</label>
                <div class="col-sm-4">
                    <select class="form-control" name="punctuality" id="punctuality" required>
                      <option hidden value="0">Rate here</option>
                        <option value="1" style="text-align:center;">1</option>
                        <option value="2" style="text-align:center;">2</option>
                        <option value="3" style="text-align:center;">3</option>
                        <option value="4" style="text-align:center;">4</option>
                        <option value="5" style="text-align:center;">5</option>
                        <option value="6" style="text-align:center;">6</option>
                        <option value="7" style="text-align:center;">7</option>
                        <option value="8" style="text-align:center;">8</option>
                        <option value="9" style="text-align:center;">9</option>
                        <option value="10" style="text-align:center;">10</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-5 col-form-label" style = "color:#black;font-weight: bold">{{ __('Capacity to work in Team') }}</label>
                <div class="col-sm-4">
                    <select class="form-control" name="team_work" id="team_work" required>
                      <option hidden value="0">Rate here</option>
                        <option value="1" style="text-align:center;">1</option>
                        <option value="2" style="text-align:center;">2</option>
                        <option value="3" style="text-align:center;">3</option>
                        <option value="4" style="text-align:center;">4</option>
                        <option value="5" style="text-align:center;">5</option>
                        <option value="6" style="text-align:center;">6</option>
                        <option value="7" style="text-align:center;">7</option>
                        <option value="8" style="text-align:center;">8</option>
                        <option value="9" style="text-align:center;">9</option>
                        <option value="10" style="text-align:center;">10</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-5 col-form-label" style = "color:#black;font-weight: bold">{{ __('Documentation Skills') }}</label>
                <div class="col-sm-4">
                    <select class="form-control" name="documentation" id="documentation" required>
                      <option hidden value="0">Rate here</option>
                        <option value="1" style="text-align:center;">1</option>
                        <option value="2" style="text-align:center;">2</option>
                        <option value="3" style="text-align:center;">3</option>
                        <option value="4" style="text-align:center;">4</option>
                        <option value="5" style="text-align:center;">5</option>
                        <option value="6" style="text-align:center;">6</option>
                        <option value="7" style="text-align:center;">7</option>
                        <option value="8" style="text-align:center;">8</option>
                        <option value="9" style="text-align:center;">9</option>
                        <option value="10" style="text-align:center;">10</option>
                    </select>
                </div>
              </div>

              <div class="row">
                <label class="col-sm-5 col-form-label" style = "color:#black;font-weight: bold">{{ __('Presentation Skills') }}</label>
                <div class="col-sm-4">
                    <select class="form-control" name="presentation" id="presentation" required>
                      <option hidden value="0">Rate here</option>
                        <option value="1" style="text-align:center;">1</option>
                        <option value="2" style="text-align:center;">2</option>
                        <option value="3" style="text-align:center;">3</option>
                        <option value="4" style="text-align:center;">4</option>
                        <option value="5" style="text-align:center;">5</option>
                        <option value="6" style="text-align:center;">6</option>
                        <option value="7" style="text-align:center;">7</option>
                        <option value="8" style="text-align:center;">8</option>
                        <option value="9" style="text-align:center;">9</option>
                        <option value="10" style="text-align:center;">10</option>
                    </select>
                </div>
              </div>

              
              <div class="row">
                <label class="col-sm-5 col-form-label" style = "color:#black;font-weight: bold">{{ __('Certificate Content') }}</label>
                <div class="col-sm-5">
                    <textarea id= "content" class="form-control" name="content" maxlength="5000" placeholder="Short remark for your evaluation " rows="4" required></textarea>
                </div>
              </div>
              
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>
              </div>
            </div>
          </div>
        </form>
      </div> 
    </div>
  </div>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
  $(document).ready(function(){
    $("#internname").change(function(){
      if($('#internname').val() != null){
            $.ajax({
                type    : 'POST',
                url     : '{!! route("getInternProject") !!}',
                data    : {"internId"   : $('#internname').val(), _token: '{{csrf_token()}}' },
                dataType: 'json',
            }).done(function (data) {
                console.log(data);
                 $('#projectpref1').append($('<option>').text(data.projectname).attr('value', data.id));
                /*$('#projectpref1').append($('<option>').text('--Select Project--').attr( {'value': '','selected': true}));
                for(var i = 0; i < data.length; i++){
                  alert(data[i]);
                  $('#projectpref1').append($('<option>').text(data[i]).attr('value', data[i]));
                }*/
            }).fail(function () {
                alert('Sorry, No Project Found');
            });
      }//end of if condition
    });
  });
</script>