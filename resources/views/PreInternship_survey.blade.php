@extends('layouts.app', ['activePage' => 'survey', 'titlePage' => __('Pre-Internship Survey')])

@section('content') 
  <div class="content">
    <div class="container-fluid">
      <div class="col-md-12">
        <form method="post" id="sectionForm" action="{{ route('submitsurvey') }}" autocomplete="off" class="form-horizontal">
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
                <h4 class="card-title"><b>{{ __('Pre-Internship Survey') }}</b></h4>
            </div>
            <div class="card-body">
              <br><br>
            <div class="card-panel card-header-info">
              <h4 class="card-title"><b>{{ __('Lecture Series') }}</b></h4>
              We'll be arranging lectures by faculty colleagues from IIT Bombay and other schools (please indicate your preferences)
            </div>
            <br><br>
            <div class="row" id="sectionForm">
              <div class="col-lg-4">
                <h4><b>Which of the following technical topics would you be interested in? </b></h4>
              </div>
                <div class="col-lg-8 form-group options">
                  <input type="checkbox" name="topics[]" value="Machine Learning/ Artificial Intelligence"> &nbsp; Machine Learning / Artificial Intelligence  <br>
                  <input type="checkbox" name="topics[]" value="Image Processing/ Computer Graphics/ Computer Vision"> &nbsp; Image Processing/ Computer Graphics/ Computer Vision <br>
                  <input type="checkbox" name="topics[]" value="Speech Processing/ NLP">&nbsp; Speech Processing/ NLP <br>
                  <input type="checkbox" name="topics[]" value="3D Design">&nbsp; 3D Design <br>
                  <input type="checkbox" name="topics[]" value="Machine Learning/ Artificial Intelligence">&nbsp; Machine Learning / Artificial Intelligence  <br>
                  <input type="checkbox" name="topics[]" value="Software System">&nbsp; Software System <br>
                  <input type="checkbox" name="topics[]" value="Control System / Robotics / Embedded Systems">&nbsp; Control System / Robotics / Embedded Systems <br>
                  <input type="checkbox" name="topics[]" value="Education Research / Education Technology">&nbsp; Education Research / Education Technology <br>
                  <input type="checkbox" name="topics[]" value="Other" onclick="ShowHideDiv1(this)">&nbsp; Other
                  <div id="dvtopics" style="display: none">
                    Other Topics
                    <input type="text" class="form-control" id="txttopics" />
                  </div>
                </div>

            </div>
            <br><br>
            <div class="row" id="section2Form">
              <div class="col-lg-4">
                <h4><b>Which non-academic topics interest you? Our attempt is to make these sessions interactive with specialists! *</b></h4>
              </div>
                <div class="col-lg-8">
                  <input type="checkbox" name="specialists[]" value="Money & Finance (how do I make my money work for me?)"> &nbsp;Money & Finance (how do I make my money work for me?)<br>
                  <input type="checkbox" name="specialists[]" value="Entrepreneurship (you don't have to be born into it, entrepreneurship can be learnt!)"> &nbsp; Entrepreneurship (you don't have to be born into it, entrepreneurship can be learnt!)<br>
                  <input type="checkbox" name="specialists[]" value="Geopolitics (each of us needs to understand how the dance of big powers affect our lives)">&nbsp; Geopolitics (each of us needs to understand how the dance of big powers affect our lives)<br>
                  <input type="checkbox" name="specialists[]" value="History (those who don't read history are doomed to repeat the same mistakes)">&nbsp; History (those who don't read history are doomed to repeat the same mistakes)<br>
                  <input type="checkbox" name="specialists[]" value="Literature (keeping company of great minds - the value of reading fiction is overlooked today)">&nbsp; Literature (keeping company of great minds - the value of reading fiction is overlooked today)<br>
                 <input type="checkbox" name="specialists[]" value="Mental Health (much neglected today - how to recognize conditions before it's too late? )">&nbsp; Mental Health (much neglected today - how to recognize conditions before it's too late? )<br>
                  <input type="checkbox" name="specialists[]" value="Meditation & Mindfulness (how do I respond optimally to situations in life - esp. stress?)">&nbsp; Meditation & Mindfulness (how do I respond optimally to situations in life - esp. stress?)<br>
                  <input type="checkbox" name="specialists[]" value="Design (importance of design is often overlooked - it's the key to successful engineering!)">&nbsp; Design (importance of design is often overlooked - it's the key to successful engineering!)<br>
                  <input type="checkbox" name="specialists[]" value="Academic Paper Writing ( How to write an effective research paper)">&nbsp; Academic Paper Writing ( How to write an effective research paper)<br>
                  <input type="checkbox" name="specialists[]" value="Soft Skills (How do I present myself?)">&nbsp; Soft Skills (How do I present myself?)<br>
                  <input type="checkbox" name="specialists[]" value="Other" onclick="ShowHideDiv2(this)">&nbsp; Other<br>
                  <div id="dvspecialists" style="display: none">
                    Other Non-academic Topics
                    <input type="text" class="form-control" id="txtspecialists" />
                  </div>
                </div>
            </div>
            <br><br>
            <div class="card-panel card-header-info">
              <h4 class="card-title"><b>{{ __('Internet Access') }}</b></h4>
              The kind of internet access you have is critical in remote internship!
            </div>
            <br><br>
            <div class="row" id ="section3Form">
              <div class="col-lg-4">
                <h4><b>Type of Internet Connection *</b></h4>
              </div>
                <div class="col-lg-8">
                  <input type="checkbox" name="Internet[]" value="Cable">&nbsp; Cable  &nbsp;&nbsp;
                  <input type="checkbox" name="Internet[]" value="Dongle">&nbsp; Dongle &nbsp;&nbsp;
                  <input type="checkbox" name="Internet[]" value="Mobile Data">&nbsp; Mobile Data &nbsp;&nbsp;
                  <input type="checkbox" name="Internet[]" value="Fiber Optic">&nbsp; Fiber Optic &nbsp;&nbsp;
                </div>
            </div>
            <br>
            <div class="row" id ="section4Form">
              <div class="col-lg-4">
                <h4><b>Service Provider *</b></h4>
              </div>
                <div class="col-lg-8">
                  <input type="checkbox" name="Service[]" value="Reliance jio">&nbsp; Reliance jio  &nbsp;&nbsp;
                  <input type="checkbox" name="Service[]" value="Airtel">&nbsp; Airtel &nbsp;&nbsp;
                  <input type="checkbox" name="Service[]" value="Vodafone Idea Limited">&nbsp; Vodafone Idea Limited &nbsp;&nbsp;
                  <input type="checkbox" name="Service[]" value="BSNL">&nbsp; BSNL &nbsp;&nbsp;
                  <input type="checkbox" name="Service[]" value="ACT Fibernet">&nbsp; ACT Fibernet  &nbsp;&nbsp;
                  <input type="checkbox" name="Service[]" value="Hathway">&nbsp; Hathway &nbsp;&nbsp;
                  <input type="checkbox" name="Service[]" value="GTPL Broadband Pvt. Ltd.">&nbsp; GTPL Broadband Pvt. Ltd. &nbsp;&nbsp;
                  <input type="checkbox" name="Service[]" value="Other" onclick="ShowHideDiv3(this)">&nbsp; Other &nbsp;&nbsp;
                  <div id="dvservice" style="display: none">
                    Other Service Provider
                    <input type="text" class="form-control" id="txtservice" />
                  </div>
                </div>
            </div>
              <br>
            <div class="row">
                <div class="col-lg-4">
                  <h4><b>Average speed of network (in Mbps) *</b></h4>
                  You can use websites like <a href="www.speedtest.net" target="_blank">speedtest.net</a>  to check your internet speed.
                </div>
                <div class="col-lg-8">
                  <input class="form-control" type="text" name="speed" id="speed" maxlength="10" placeholder="Average speed" value="{{old('speed')}}" required>
                </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-4">
                <h4><b>Rate your Internet connection (on the basis of video streaming/ calling) *</b></h4>
              </div>
              <div class="col-lg-8">
                  <div class="input-field {{ $errors->has('rate') ? ' has-danger' : '' }}">
                    <select class="col s12 form-control" name="rate" id="rate" required>
                      <option hidden value="">Choose</option>
                      <option value="Can not stream video or make video call" {{ old('rate') == "Can not stream video or make video call" ? 'selected': '' }}>Can not stream video or make video call</option>
                      <option value="Can make video calls but is very unreliable(intermittent connection)" {{ old('rate') == "Can make video calls but is very unreliable(intermittent connection)" ? 'selected': '' }}>Can make video calls but is very unreliable(intermittent connection)</option>
                      <option value="Stable video call/streaming but poor quality" {{ old('rate') == "Stable video call/streaming but poor quality" ? 'selected': '' }}>Stable video call/streaming but poor quality</option>
                      <option value="High speed internet" {{ old('rate') == "High speed internet" ? 'selected': '' }}>High speed internet</option>
                    </select>
                    @if ($errors->has('rate'))
                      <span id="rate-error" class="error text-danger" for="rate">{{ $errors->first('rate') }}</span>
                    @endif
                  </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-4">
                <h4><b>Are there any power cuts in your residing area? *</b></h4>
              </div>
              <div class="col-lg-8">
                  <div class="{{ $errors->has('power') ? ' has-danger' : '' }}">
                    <select class="col s12 form-control" name="power" id="power" required>
                      <option hidden value="">Choose</option>
                      <option value="Very frequent power cut" {{ old('power') == "Very frequent power cut" ? 'selected': '' }}>Very frequent power cut</option>
                      <option value="Occasional power cut" {{ old('power') == "Occasional power cut" ? 'selected': '' }}>Occasional power cut</option>
                      <option value="No power cut" {{ old('power') == "No power cut" ? 'selected': '' }}>No power cut</option>
                    </select>
                    @if ($errors->has('power'))
                      <span id="power-error" class="error text-danger" for="power">{{ $errors->first('power') }}</span>
                    @endif
                  </div>
              </div>
            </div>
            <br><br>
            <div class="card-header card-header-info">
                <h4 class="card-title"><b>{{ __('Laptop specifications') }}</b></h4>
            </div>
            <br><br>
            <div class="row">
              <div class="col-lg-4">
                <h4><b>Laptop Specifications(Make and Model) *</b></h4>
                Given that this is a remote internship, it is essential that you have a laptop.
              </div>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="model" id="model" maxlength="50" placeholder="Laptop Specifications" value="{{old('model')}}" required>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-4">
                <h4><b>RAM (In GB) *</b></h4>
              </div>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="ram" id="ram" maxlength="50" placeholder="RAM" value="{{old('ram')}}" required>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-4">
                <h4><b>Storage (In GB) *</b></h4>
              </div>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="storage" id="storage" maxlength="50" placeholder="Storage" value="{{old('storage')}}" required>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-4">
                <h4><b>Processor *</b></h4>
              </div>
              <div class="col-lg-8">
                  <div class="input-field {{ $errors->has('processor') ? ' has-danger' : '' }}">
                    <select class="col s12 form-control" name="processor" id="processor" required>
                      <option hidden value="">Choose</option>
                      <option value="Pentium" {{ old('processor') == "Pentium" ? 'selected': '' }}>Pentium</option>
                      <option value="i3" {{ old('processor') == "i3" ? 'selected': '' }}>i3</option>
                      <option value="i5" {{ old('processor') == "i5" ? 'selected': '' }}>i5</option>
                      <option value="i7" {{ old('processor') == "i7" ? 'selected': '' }}>i7</option>
                      <option value="ARM9" {{ old('processor') == "ARM9" ? 'selected': '' }}>ARM9</option>
                      <option value="M1(Apple)" {{ old('processor') == "M1(Apple)" ? 'selected': '' }}>M1(Apple)</option>
                      <option value="Other" {{ old('processor') == "Other" ? 'selected': '' }}>Other</option>
                    </select>
                    @if ($errors->has('power'))
                      <span id="processor-error" class="error text-danger" for="processor">{{ $errors->first('processor') }}</span>
                    @endif
                  </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-4">
                <h4><b>Processor Generation (9/10/11) *</b></h4>
              </div>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="processorgeneration" id="processorgeneration" maxlength="50" placeholder="Processor Generation" value="{{old('processorgeneration')}}" required>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-4">
                <h4><b>Graphics Card Capacity (in GB) *</b></h4>
                If none, please choose N/A
              </div>
              <div class="col-lg-8">
                  <div class="input-field {{ $errors->has('graphics') ? ' has-danger' : '' }}">
                    <select class="col s12 form-control" name="graphics" id="graphics" required>
                      <option hidden value="">Choose</option>
                      <option value="N/A" {{ old('graphics') == "N/A" ? 'selected': '' }}>N/A</option>
                      <option value="2" {{ old('graphics') == "2" ? 'selected': '' }}>2</option>
                      <option value="4" {{ old('graphics') == "4" ? 'selected': '' }}>4</option>
                      <option value="8" {{ old('graphics') == "8" ? 'selected': '' }}>8</option>
                      <option value="Other" {{ old('graphics') == "Other" ? 'selected': '' }}>Other</option>
                    </select>
                    @if ($errors->has('graphics'))
                      <span id="graphics-error" class="error text-danger" for="graphics">{{ $errors->first('graphics') }}</span>
                    @endif
                  </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-4">
                <h4><b>OS and Version *</b></h4>
                You can select multiple options (in case of multiple boot)
              </div>
              <div class="col-lg-8">
                  <div class="input-field {{ $errors->has('os') ? ' has-danger' : '' }}">
                    <select class="col s12 form-control" name="os" id="os" required>
                      <option hidden value="">Choose</option>
                      <option value="Windows" {{ old('os') == "Windows" ? 'selected': '' }}>Windows</option>
                      <option value="Mac OS" {{ old('os') == "Mac OS" ? 'selected': '' }}>Mac OS</option>
                      <option value="Linux" {{ old('os') == "Linux" ? 'selected': '' }}>Linux(any version)</option>
                      <option value="Other" {{ old('os') == "Other" ? 'selected': '' }}>Other</option>
                    </select>
                    @if ($errors->has('os'))
                      <span id="os-error" class="error text-danger" for="os">{{ $errors->first('os') }}</span>
                    @endif
                  </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-lg-4">
                <h4><b>Laptop Benchmark Score *</b></h4>
              </div>
              <div class="col-lg-8">
                <input class="form-control" type="text" name="benchmark" id="ebnchmark" maxlength="50" placeholder="Laptop Benchmark Score" value="{{old('benchmark')}}" required>
              </div>
            </div>
            <br><br>

            <center>
              <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                <button type="submit" value="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
              </div>
            </center>
            </div>
            </div>
          </div>
        </form>
      </div> 
    </div>
  </div>
@endsection

@push('js')
<script type="text/javascript">
  (function() {
    const form = document.querySelector('#sectionForm');
    const checkboxes = form.querySelectorAll('input[type=checkbox]');
    const checkboxLength = checkboxes.length;
    const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

    function init() {
        if (firstCheckbox) {
            for (let i = 0; i < checkboxLength; i++) {
                checkboxes[i].addEventListener('change', checkValidity);
            }

            checkValidity();
        }
    }

    function isChecked() {
        for (let i = 0; i < checkboxLength; i++) {
            if (checkboxes[i].checked) return true;
        }

        return false;
    }

    function checkValidity() {
        const errorMessage = !isChecked() ? 'At least one checkbox must be selected.' : '';
        firstCheckbox.setCustomValidity(errorMessage);
    }

    init();
})();
</script>
<script type="text/javascript">
  (function() {
    const form = document.querySelector('#section2Form');
    const checkboxes = form.querySelectorAll('input[type=checkbox]');
    const checkboxLength = checkboxes.length;
    const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

    function init() {
        if (firstCheckbox) {
            for (let i = 0; i < checkboxLength; i++) {
                checkboxes[i].addEventListener('change', checkValidity);
            }

            checkValidity();
        }
    }

    function isChecked() {
        for (let i = 0; i < checkboxLength; i++) {
            if (checkboxes[i].checked) return true;
        }

        return false;
    }

    function checkValidity() {
        const errorMessage = !isChecked() ? 'At least one checkbox must be selected.' : '';
        firstCheckbox.setCustomValidity(errorMessage);
    }

    init();
})();
</script>
<script type="text/javascript">
  (function() {
    const form = document.querySelector('#section3Form');
    const checkboxes = form.querySelectorAll('input[type=checkbox]');
    const checkboxLength = checkboxes.length;
    const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

    function init() {
        if (firstCheckbox) {
            for (let i = 0; i < checkboxLength; i++) {
                checkboxes[i].addEventListener('change', checkValidity);
            }

            checkValidity();
        }
    }

    function isChecked() {
        for (let i = 0; i < checkboxLength; i++) {
            if (checkboxes[i].checked) return true;
        }

        return false;
    }

    function checkValidity() {
        const errorMessage = !isChecked() ? 'At least one checkbox must be selected.' : '';
        firstCheckbox.setCustomValidity(errorMessage);
    }

    init();
})();
</script>
<script type="text/javascript">
  (function() {
    const form = document.querySelector('#section4Form');
    const checkboxes = form.querySelectorAll('input[type=checkbox]');
    const checkboxLength = checkboxes.length;
    const firstCheckbox = checkboxLength > 0 ? checkboxes[0] : null;

    function init() {
        if (firstCheckbox) {
            for (let i = 0; i < checkboxLength; i++) {
                checkboxes[i].addEventListener('change', checkValidity);
            }

            checkValidity();
        }
    }

    function isChecked() {
        for (let i = 0; i < checkboxLength; i++) {
            if (checkboxes[i].checked) return true;
        }

        return false;
    }

    function checkValidity() {
        const errorMessage = !isChecked() ? 'At least one checkbox must be selected.' : '';
        firstCheckbox.setCustomValidity(errorMessage);
    }

    init();
})();
</script>

<script type="text/javascript">
  function ShowHideDiv1(chkPassport) 
  {
    var dvtopics = document.getElementById("dvtopics");
    dvtopics.style.display = chkPassport.checked ? "block" : "none";
  }
</script>
<script type="text/javascript">
  function ShowHideDiv2(chkPassport) 
  {
    var dvspecialists = document.getElementById("dvspecialists");
    dvspecialists.style.display = chkPassport.checked ? "block" : "none";
  }
</script>
<script type="text/javascript">
function ShowHideDiv3(chkPassport) 
  {
    var dvservice = document.getElementById("dvservice");
    dvservice.style.display = chkPassport.checked ? "block" : "none";
  }
</script>




@endpush


<!-- <script>
$(function(){
    var requiredCheckboxes = $('.options :checkbox[required]');
    requiredCheckboxes.change(function(){
        if(requiredCheckboxes.is(':checked')) {
            requiredCheckboxes.removeAttr('required');
        } else {
            requiredCheckboxes.attr('required', 'required');
        }
    });
});
</script> -->

