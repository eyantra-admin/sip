@extends('layouts.app', ['activePage' => 'Allocate_Project', 'titlePage' => __('Allocate_Project')])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
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

<!------------ Student list --------------->
      <div class = "row">
        <div class="col-md-12" style="margin-top: 25px">
          
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Student List</h4>
                <p class="card-category"> List of all students selected in eYSIP-2022.</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="student_table"> 
                  <thead class=" text-primary">
                    <th><b>Sr No.</b></th>
                    <th><b>User ID</b></th>
                    <th><b>Student Name</b></th>
                    <th><b>Select Projects</b></th>
                    <th><b>Allocate Project to a Student</b></th>
                  </thead>
                      <tbody>
                        @foreach($students as $key=>$cur)
                        <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$cur->id}}</td>
                          <td>{{$cur->name}}</td>
                          
                          <td>
                          @if($cur->project_alloted == 0)
                            <!-- <select class="form-control" name="project" id="project" required>
                              <option hidden value="0">Select project to be allotted</option>
                              @foreach($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->projectname }}</option>
                              @endforeach
                            </select> -->
                            Project not alloted
                          @else
                            {{ $cur->projectname }}
                          @endif 
                        </td>
                        <td>
                          @if($cur->project_alloted == 0)
                           <!-- <a class="btn btn-success" onclick="return confirm('Are you sure?')"
                          href="/AllocateProject_Submit/{{$cur->id}}/{{$project->id}}"><span>Allocate</span></a> -->
                          Contact Web team
                          @else
                            Project Allotted
                          @endif 
                        </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script> 
  $(document).ready(function(){
     $('#student_table').DataTable(
      {
         // Sets the row-num-selection "Show %n entries" for the user
        "lengthMenu": [ 25, 50, 75, 100, 125,150, 175,200,250 ], 
        
        // Set the default no. of rows to display
        "pageLength": 50 
      });
    
  });
</script>
@endpush
