<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top text-white">
  <div class="container">
    <div class="navbar-wrapper">
      <!-- <a class="navbar-brand" href="{{ route('home') }}">{{ $title }}</a> -->
      <img style="width: 250px; margin-top: 10px" src="{{ asset('material') }}/img/logo.svg" alt="e-Yantra">

    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
      <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <ul class="navbar-nav">
        <!-- <li class="nav-item">
          <a href="{{ route('home') }}" class="nav-link">
            <i class="material-icons">dashboard</i> {{ __('Dashboard') }}
          </a>
        </li> -->
        <!-- <li class="nav-item{{ $activePage == 'register' ? ' active' : '' }}">
          <a href="{{ route('registration') }}" class="nav-link">
            <i class="material-icons">person_add</i> {{ __('Register') }}
          </a>
        </li>
        -->
        <li class="nav-item ">
          <a href="{{ route('keycloak.login') }}" class="nav-link">
            <i class="material-icons">fingerprint</i> {{ __('Login') }}
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->