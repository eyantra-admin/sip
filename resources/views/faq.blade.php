@extends('layouts.app', ['activePage' => 'FAQ', 'titlePage' => __('FAQ')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="card card-nav-tabs">
        <div class="card-header card-header-primary">
          <b>Frequently Asked Questions</b>
        </div>
        <div class="card-body">
          <ul class="collapsible">
            <li>
              <div class="collapsible-header"><h3><b>First</b></h3></div>
              <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
            </li>
            <li>
              <div class="collapsible-header"><h3><b>Second</b></h3></div>
              <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
            </li>
            <li>
              <div class="collapsible-header"><h3><b>Third</b></h3></div>
              <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
            </li>
          </ul>
        </div>
      </div>
    </div>    
  </div>
@endsection

@push('js')
  <script>
  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
  </script>


@endpush