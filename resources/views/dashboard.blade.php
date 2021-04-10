@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="card card-nav-tabs">
        <div class="card-header card-header-warning">
          <b>Welcome to eYSIP</b>
        </div>
        @if($form_submitted != 1)
          <div class="card-body">
            <h4 class="card-title"><b>You are required to submit your complete profile(along with projects you worked on) in order to get assigned to a project.</b> </h4>
            <br><br>
            <p class="card-text" style="color: Red"><b>NOTE:</b> Please note that, the information once filled cannot be changed/modified later. We will proceed with the information you submit here.</p>
             <p class="card-text"><b>NOTE:</b> If you have already participated in any of the MOOC Cources, create a single file of all Certificate images / Progress (online screenshot) compiled in one PDF.<br> You need to upload the PDF while submitting your form.</p>
            <a href="/SipRegistration" class="btn btn-primary">Fill Form</a>
          </div>
        @else
          <div class="card-body">
             <h4 class="card-title"><b>Profile submission done successfully.<br> It's time to see projects and add your preferences.</b> </h4><br><br>
             <h4 class="card-title"><b><p style="font-weight: 2px; color: Red">
               Please note the following points before proceeding with adding your project preferences.</p></b>
            </h4>
             <ul>
              <h4 class="card-title">
               <li>You have required to provide 3 project preferences on basis of the skill set you possess.<br> A project in Preference 1 will be the project you think is the most preferred by you.</li>
               <li>We will try our best to allot a project to you depending upon the preferences given by you. But do not gurantee this.</li>
               <li>It is possible that, in any case of project allotment, you may be assigned a project that is not in your preference list.</li>
             </h4>
             </ul>
          </div>
        @endif
        
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush