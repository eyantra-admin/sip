<div class="sidebar" data-color="purple" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="http://eysip.e-yantra.org/home" class="simple-text logo-normal">
      <img style="width: 250px; margin-top: 10px" src="{{ asset('material') }}/img/logo.svg" alt="e-Yantra">
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      @if(Auth::user()->role == 1)
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      @endif

      <!-- <li class="nav-item{{ $activePage == 'changepassword' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('changepassword') }}">
           <span>
                <i class="material-icons">face</i>
            </span>
          <span class="sidebar-normal">{{ __('Change Password') }} </span>
        </a>
      </li> -->
      <!-- <li class="nav-item{{ $activePage == 'preference' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('projectpreference') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Project Preference') }}</p>
        </a>
      </li> -->
      <!-- <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelExample" aria-expanded="true">
          <i><img style="width:25px" src="{{ asset('material') }}/img/laravel.svg"></i>
          <p>{{ __('Laravel Examples') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="laravelExample">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li> -->
      
  @if(Auth::user()->role == 1)
    {{--
    @if( Auth::user()->profilesubmitted == 1)
    <li class="nav-item{{ $activePage == 'timeslotbooking' ? ' active' : '' }}">
      <a class="nav-link" href="{{ route('timeslotbooking') }}">
        <i class="material-icons">library_books</i>
        <p>{{ __('Interview Slot') }}</p>
      </a>
    </li>
    <li class="nav-item{{ $activePage == 'preference' ? ' active' : '' }}">
      <a class="nav-link" href="{{ route('projectpreference') }}">
        <i class="material-icons">content_paste</i>
        <p>{{ __('Project Preference') }}</p>
      </a>
    </li>   
    @endif
    --}}  

    @if(Auth::user()->selected == 1)
        <li class="nav-item{{ $activePage == 'get-payment-info' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('paymentpage') }}">
            <i class="material-icons">Payment</i>
              <p>{{ __('Internship Fee Payment') }}</p>
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'nda' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('nda') }}">
            <i class="material-icons">content_paste</i>
              <p>{{ __('NDA') }}</p>
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'bank_details' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('bank_details') }}">
            <i class="material-icons">content_paste</i>
              <p>{{ __('Submit VendorID') }}</p>
          </a>
        </li>
        <!-- <li class="nav-item{{ $activePage == 'survey' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('survey') }}">
            <i class="material-icons">list</i>
              <p>{{ __('Internship Survey') }}</p>
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'bank_details' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('bank_details') }}">
            <i class="material-icons">content_paste</i>
              <p>{{ __('Fill Personal Details') }}</p>
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'verifydetails' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('verifydetails') }}">
            <i class="material-icons">unarchive</i>
              <p>{{ __('Verify your details') }}</p>
          </a>
        </li> -->
       
        
        <!-- <li class="nav-item{{ $activePage == 'timeslotbooking' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('timeslotbooking') }}">
            <i class="material-icons">library_books</i>
              <p>{{ __('Interview Slot') }}</p>
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'preference' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('projectpreference') }}">
            <i class="material-icons">content_paste</i>
              <p>{{ __('Project Preference') }}</p>
          </a>
        </li> -->
    @endif
  @endif

  <!-- only for J&K students -->
  @if(Auth::user()->role == 4)
    <li class="nav-item{{ $activePage == 'get-payment-info' ? ' active' : '' }}">
      <a class="nav-link" href="{{ route('paymentpage') }}">
        <i class="material-icons">Payment</i>
        <p>{{ __('Internship Fee Payment') }}</p>
      </a>
    </li>

    <li>
      <a class="nav-link" href="{{ route('keycloak.logout') }}">
        <i class="material-icons">Logout</i>
        <p>{{ __('Logout') }}</p>
      </a>
    </li>
  @endif  


    <!--   ***********MENTOR INTERFACE******** -->
    @if(Auth::user()->role == 2)
      <li class="nav-item{{ $activePage == 'addproject' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('project.addproject') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Add Project') }}</p>
        </a>
      </li>
      
    
      <!-- <li class="nav-item{{ $activePage == 'viewpreferences' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('viewpreferences') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('View Project Preferences') }}</p>
        </a>
      </li> -->
      <li class="nav-item{{ $activePage == 'prjPreferenceByPanel' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('prjPreferenceByPanel') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('View Projects') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'viewtimeslot' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('viewtimeslot') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('View Timeslot Bookings') }}</p>
        </a>
      </li>
      
      
      <!-- <li class="nav-item{{ $activePage == 'InterviewResult' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('Evaluation') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Student Interview') }}</p>
        </a>
      </li> -->

      <li class="nav-item{{ $activePage == 'Progress_Eval' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('Progress_Eval') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Intern Progress Evaluation') }}</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'final_eval' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('final_eval') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Final Progress Evaluation') }}</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'internevaltable' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('internevaltable') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Final Evaluation Content') }}</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'mentorclearence' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('mentorclearence') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Mentor Clearence') }}</p>
        </a>
      </li>

    @endif

    <!--   ***********ADMIN INTERFACE******** -->
    @if(Auth::user()->role == 3)
      <li class="nav-item{{ $activePage == 'View_profiles' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('View_profiles') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('View All Interns Data') }}</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'Allocate_Project' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('Allocate_Project') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Student - Project Allocation') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'listnda' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('nda_all') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('View NDA Submissions') }}</p>
        </a>
      </li>      
      <li class="nav-item{{ $activePage == 'View_projects' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('View_projects') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('View All Projects') }}</p>
        </a>
      </li>
    @endif

    </ul>
  </div>
</div>