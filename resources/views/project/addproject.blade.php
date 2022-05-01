@extends('layouts.app', ['activePage' => 'addproject', 'titlePage' => __('Add Project')])

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

      <!-- ------Add project table------- -->
      
      <div class="col-md-12">
        <form method="post" action="{{ route('insertproject') }}" autocomplete="off" class="form-horizontal">
          @csrf


          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Add Project') }}</h4>
              <p class="card-category">{{ __('Add project that you will be mentoring along with its brief abstract and technology stack.') }}</p>
            </div>
            <div class="card-body">
              <div class="row">
                <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Project Name') }}</label>
                <div class="col-sm-7">
                  <input class="form-control" type="text" name="projectname" id="projectname" placeholder="Project Name" value="{{old('model')}}" required>
                </div>
              </div><br>
              <div class="row">
                <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Project Abstract') }}</label>
                <div class="col-sm-7">
                  <textarea class="form-control" name="projectabstract" id="projectabstract" required 
                        placeholder="Add Project Abstract" value="{{old('projectabstract')}}" rows="4" wrap="physical"></textarea>
                </div>
              </div><br>
              <div class="row">
                <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('No of Interns Required') }}</label>
                <div class="col-sm-7">
                  <input type="number" class="form-control" name="interns" id="interns" 
                        placeholder="No of Interns Required" value="{{old('interns')}}" required>
                </div>
              </div><br>
              <div class="row">
                <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Technology Stack') }}</label>
              </div>
              <div class="row">
                
                @foreach($skills as $skill)
                <div class="col-sm-7">
                 
                  <input type="checkbox" name="technologystack[]" value="{{$skill->skill}}"> <label>{{$skill->skill}}</label>

                </div>
                @endforeach
                

              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary"  style="margin-left: 500px">{{ __('Save') }}</button>
              </div>
            </div>
          </div>
        </form>

        <form method="post" action="{{ route('project.savementorproject') }}" autocomplete="off" class="form-horizontal">
          @csrf
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ __('Mentor - Project Allocation') }}</h4>
              <p class="card-category">{{ __('Assign mentors to a project.  You can assign maximum of 3 mentors') }}</p>
            </div>
            <div class="card-body">
              <div class="row">
                <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Project Name') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12 form-control" name="project" id="project" required>
                      <option hidden value="">Select your project</option>
                      @foreach($projects as $project)
                        <option value="{{$project->id}}" {{old('project') == $project->id ? 'selected' : ''  }}>{{$project->projectname}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('projectt'))
                      <span id="project-error" class="error text-danger" for="project">{{ $errors->first('project') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Mentor 1') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12 form-control" name="mentor1" id="mentor1" required>
                      <option hidden value="0">Select Mentor 1</option>
                      @foreach($mentors as $mentor1)
                        <option value="{{$mentor1->id}}" {{old('mentor1') == $mentor1->id ? 'selected' : ''  }}>{{$mentor1->mentorname}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('mentor'))
                      <span id="mentor1-error" class="error text-danger" for="mentor1">{{ $errors->first('mentor1') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Mentor 2') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12 form-control" name="mentor2" id="mentor2">
                      <option hidden value="0">Select Mentor 2</option>
                      @foreach($mentors as $mentor2)
                        <option value="{{$mentor2->id}}" {{old('mentor2') == $mentor2->id ? 'selected' : ''  }}>{{$mentor2->mentorname}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('mentor2'))
                      <span id="mentor2-error" class="error text-danger" for="mentor2">{{ $errors->first('mentor2') }}</span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 col-form-label" style = "color:black;font-weight: bold">{{ __('Mentor 3') }}</label>
                <div class="col-sm-7">
                  <div class="input-field {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <select class="col s12 form-control" name="mentor3" id="mentor3">
                      <option hidden value="0">Select Mentor 3</option>
                      @foreach($mentors as $mentor3)
                        <option value="{{$mentor3->id}}" {{old('mentor3') == $mentor3->id ? 'selected' : ''  }}>{{$mentor3->mentorname}}</option>
                      @endforeach
                    </select>
                    @if ($errors->has('projectt'))
                      <span id="mentor3-error" class="error text-danger" for="mentor3">{{ $errors->first('mentor3') }}</span>
                    @endif
                  </div>
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

<style type="text/css">
  * {
  box-sizing: border-box;
}

.dropdown {
  position: relative;
  margin-bottom: 20px;

  .dropdown-list {
    padding: 25px 20px;
    background: #fff;
    position: absolute;
    top: 50px;
    left: 0;
    right: 0;
    border: 1px solid rgba(black, .2);
    max-height: 223px;
    overflow-y: auto;
    background: #fff;
    display: none;
    z-index: 10;
  }
  
  .checkbox {
    opacity: 0;
    transition: opacity .2s;
  }
  
  .dropdown-label {
    display: block;
    height: 44px;
    font-size: 16px;
    line-height: 42px;
    background: #fff;
    border: 1px solid rgba(black, .2);
    padding: 0 40px 0 20px;
    cursor: pointer;
    position: relative;
    
    &:before {
      content: '▼';
      position: absolute;
      right: 20px;
      top: 50%;
      transform: translateY(-50%);
      transition: transform .25s;
      transform-origin: center center;
    }
  }
  &.open {
    .dropdown-list {
      display: block;
    }
    .checkbox {
      transition: 2s opacity 2s;
      opacity: 1;
    }
    .dropdown-label:before {
      transform: translateY(-50%) rotate(-180deg);
    }
  }
}

.checkbox {
  margin-bottom: 20px;
  &:last-child {  
    margin-bottom: 0;
  }
  
  .checkbox-custom {
    display: none;
  }

  .checkbox-custom-label {
    display: inline-block;
    position: relative;
    vertical-align: middle;
    cursor: pointer;
  }

  .checkbox-custom + .checkbox-custom-label:before {
    content: '';
    background: transparent;
    display: inline-block;
    vertical-align: middle;
    margin-right: 10px;
    text-align: center;
    width: 12px;
    height: 12px;
    border: 1px solid rgba(black, .3);
    border-radius: 2px;
    margin-top: -2px;
  }

  .checkbox-custom:checked + .checkbox-custom-label:after {
    content: '';
    position: absolute;
    top: 2px;
    left: 4px;
    height: 4px;
    padding: 2px;
    transform: rotate(45deg);
    text-align: center;
    border: solid #000;
    border-width: 0 2px 2px 0;
  }
  .checkbox-custom-label {
    line-height: 16px;
    font-size: 16px;
    margin-right: 0;
    margin-left: 0;
    color: black;
  }
}
</style>

@push('js')
<script type="text/javascript">
  
function checkboxDropdown(el) {
  var $el = $(el)

  function updateStatus(label, result) {
    if(!result.length) {
      label.html('Select Options');
    }
  };
  
  $el.each(function(i, element) {
    var $list = $(this).find('.dropdown-list'),
      $label = $(this).find('.dropdown-label'),
      $checkAll = $(this).find('.check-all'),
      $inputs = $(this).find('.check'),
      defaultChecked = $(this).find('input[type=checkbox]:checked'),
      result = [];
    
    updateStatus($label, result);
    if(defaultChecked.length) {
      defaultChecked.each(function () {
        result.push($(this).next().text());
        $label.html(result.join(", "));
      });
    }
    
    $label.on('click', ()=> {
      $(this).toggleClass('open');
    });

    $checkAll.on('change', function() {
      var checked = $(this).is(':checked');
      var checkedText = $(this).next().text();
      result = [];
      if(checked) {
        result.push(checkedText);
        $label.html(result);
        $inputs.prop('checked', false);
      }else{
        $label.html(result);
      }
        updateStatus($label, result);
    });

    $inputs.on('change', function() {
      var checked = $(this).is(':checked');
      var checkedText = $(this).next().text();
      if($checkAll.is(':checked')) {
        result = [];
      }
      if(checked) {
        result.push(checkedText);
        $label.html(result.join(", "));
        $checkAll.prop('checked', false);
      }else{
        let index = result.indexOf(checkedText);
        if (index >= 0) {
          result.splice(index, 1);
        }
        $label.html(result.join(", "));
      }
      updateStatus($label, result);
    });

    $(document).on('click touchstart', e => {
      if(!$(e.target).closest($(this)).length) {
        $(this).removeClass('open');
      }
    });
  });
};

checkboxDropdown('.dropdown');


</script>
@endpush
