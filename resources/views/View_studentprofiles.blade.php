@extends('layouts.app', ['activePage' => 'View_profiles', 'titlePage' => __('View_profiles')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class = "row">
      <div class="col-md-12" style="margin-left: 20px">
        <button onclick="exportTableToCSV('SIPStudentList.csv')" class="btn btn-primary"> Export to CSV File</button> 
        <a href="{!!route('ExportEvaluation')!!}" target="_blank">Export Evaluation Result</a> 
      </div>


        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">List of Student Profiles</h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body">
              <div class="table-responsive">

                <table class="table" id="timeslot_table" style="text-align: center;"> 
                  <thead class=" text-primary">
                    <th><b>Sr No.</b></th>
                    <th><b>User Id</b></th>
                    <th><b>Panel No</b></th>
                    <th><b>Student Name</b></th>
                    <th><b>Email Id</b></th>
                    <th><b>Payment Status</b></th>
                  </thead>
                
                  <tbody>
                      @foreach($profile_list as $key=>$cur)
                      <tr>
                        <td><b>{{$key+1}}</b></td>
                        <td><b>{{$cur->userid}}</b></td>
                        <td>
                            @if(!empty($cur->panelid))
                            <b>{{$cur->panelid}}</b>
                            @else
                            <p>Yet to assign</p>
                            @endif
                            | <b><a href="{!!route('EvaluationResultAdmin', $cur->userid)!!}">Evaluate</a></b>
                        </td>
                        <td><b><a href="{!! route('ViewMyRegistration', Crypt::encrypt($cur->userid))!!}" target="_blank" class="col-sm-4 col-form-label"><b>{{ $cur->name }}</b></a></b></td>

                        <td><b>{{$cur->email}}</b></td>
                        <td>
                          @if(!empty($cur->payment))
                            <b>{{$cur->payment}}</b>
                          @else
                            <b class="text-warning">Yet to Receive</b>  
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
<script type="text/javascript">
  function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}

//Download CSV
function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}
</script>


<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
  
  $(document).ready(function(){
     $('#timeslot_table').DataTable(
      {
         // Sets the row-num-selection "Show %n entries" for the user
        "lengthMenu": [ 25, 50, 75, 100, 125,150, 175,200,250 ], 
        
        // Set the default no. of rows to display
        "pageLength": 50 
      });
    
  });

  
</script>
@endpush