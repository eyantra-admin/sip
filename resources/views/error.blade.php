
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
        @if($errors->any())
          <div class="alert alert-danger" role='alert'>
            @foreach($errors->all() as $error)
            <center><h3 class="text-center" style="color: Red"></style>{!!$error!!}</h3></center>
            @endforeach
            <br>
            <center><a href="{{ route('keycloak.logout') }}" style="color: Red">{{ __('Back') }}</a></center>
          </div>
          <hr/>
        @endif

      </div>
  </div>
</div>

