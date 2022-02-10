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
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>

      <li class="nav-item{{ $activePage == 'changepassword' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('changepassword') }}">
           <span>
                <i class="material-icons">face</i>
            </span>
          <span class="sidebar-normal">{{ __('Change Password') }} </span>
        </a>
      </li>
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

    @if( Auth::user()->profilesubmitted == 1)
   
    @endif

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
        <li class="nav-item{{ $activePage == 'survey' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('survey') }}">
            <i class="material-icons">list</i>
              <p>{{ __('Internship Survey') }}</p>
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'verifydetails' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('verifydetails') }}">
            <i class="material-icons">unarchive</i>
              <p>{{ __('Verify your details') }}</p>
          </a>
        </li>

        <li class="nav-item{{ $activePage == 'timeslotbooking' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('timeslotbooking') }}">
          <i class="material-icons">library_books</i>
            <p>{{ __('Interview Slot') }}</p>
        </a>
      </li>
    @endif

    

      
      
        <!-- <li class="nav-item{{ $activePage == 'survey' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('survey') }}">
            <i class="material-icons">list</i>
              <p>{{ __('Pre-Internship Survey') }}</p>
          </a>
        </li>
        <li class="nav-item{{ $activePage == 'faq' ? ' active' : '' }}">
          <a class="nav-link" href="{{ route('faq') }}">
            <i class="material-icons">language</i>
              <p>{{ __('FAQ') }}</p>
          </a>
        </li> -->
    @if(Auth::user()->role == 2)
      <li class="nav-item{{ $activePage == 'addproject' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('project.addproject') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Add Project') }}</p>
        </a>
      </li>
      
    
      <li class="nav-item{{ $activePage == 'viewpreferences' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('viewpreferences') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('View Project Preferences') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'viewtimeslot' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('viewtimeslot') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('View Timeslot Bookings') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'listnda' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('nda_all') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('View NDA Submissions') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'mentorclearence' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('mentorclearence') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Mentor Clearence') }}</p>
        </a>
      </li>

    @endif
    </ul>
  </div>
</div>


<!-- <li class="nav-item{{ $activePage == 'icons' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('icons') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Result') }}</p>
        </a>
      </li> -->
      <!--<li class="nav-item{{ $activePage == 'map' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('map') }}">
          <i class="material-icons">location_ons</i>
            <p>{{ __('Maps') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'notifications' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('notifications') }}">
          <i class="material-icons">notifications</i>
          <p>{{ __('Notifications') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'language' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('language') }}">
          <i class="material-icons">language</i>
          <p>{{ __('RTL Support') }}</p>
        </a>
      </li>
      <li class="nav-item active-pro{{ $activePage == 'upgrade' ? ' active' : '' }} bg-danger">
        <a class="nav-link text-white" href="{{ route('upgrade') }}">
          <i class="material-icons">unarchive</i>
          <p>{{ __('Upgrade to PRO') }}</p>
        </a>
      </li> -->


      