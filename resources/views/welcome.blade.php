@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('eYIP')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
    @if($errors->any())
      <div class="alert alert-danger" role='alert'>
      @foreach($errors->all() as $error)
      <p>{!!$error!!}</p>
      @endforeach
      </div>
      <hr/>
      @endif
      <div class="col-lg-7 col-md-8">
          <h1 class="text-white text-center">{{ __('Welcome to e-Yantra Internship Program') }}</h1>
      </div>
  </div>
</div>
@endsection
