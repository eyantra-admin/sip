<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="_token" content="{!! csrf_token() !!}"/>
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>@yield('title')</title>
  <!-- Bootstrap -->
  <link  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
  <link href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
   <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
  <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />
  <!-- Bootstrap Date-Picker Plugin -->
 
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>

      <!-- Include all compiled plugins (below), or include individual files as needed -->

      <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
 
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <style>
        .overlay{
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height:100%;
          background: white;
          -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=60)";
          filter: alpha(opacity=60);
          -moz-opacity: .6;
          -khtml-opacity: .6;
          opacity: .6;
          z-index:1000;
        }
        .gifloader{
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background: url(../../../img/content/eyantra/eyantra-65-100-old.gif) no-repeat center;
          /*background: url(../images/eyantra/eyantra-1.gif) no-repeat center;*/
          -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
          filter: alpha(opacity=100);
          -moz-opacity: 1;
          -khtml-opacity: 1;
          opacity: 1;
          z-index:1500; 
        }
        .name{
font-family: "Georgia";
color: #C00;
font-weight: 700;
font-size: 2.46rem;
font-style: normal
}
    </style>
           @yield('style')
    </head>
    <body>
      <!--header-->
      <nav class="navbar navbar-default navbar-fixed-top" style="min-height: 70px;">
        <div class="container">
          <div class="navbar-header">
            <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a href="http://e-yantra.org" class="navbar-brand" title="e-Yantra"><img src="{!! asset('/logo.png') !!}"/></a>
          </div>
        </div>
      </nav>
      <div class="row">
        <div class="col-md-8 col-md-offset-2" style ="padding-top: 70px;">
              @yield('content')
        </div>
      </div>
      
      @include('layouts.Registration.footer')
     
      <script>
      $.ajaxSetup({
      headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
      });
      </script>

      @yield('userscript')
      @yield('scripts')   

    </body>
    </html>