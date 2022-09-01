@extends('layouts.app', ['activePage' => 'internevaltable', 'titlePage' => __('internevaltable')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class = "row">
      <div class="col-md-12" style="margin-left: 20px">
        <button onclick="exportTableToCSV('InternEvalFinal.csv')" class="btn btn-primary"> Export to CSV File</button>  
      </div>


        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Final Evaluation</h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="timeslot_table" style="text-align: center;"> 
                <thead class=" text-primary">
                  <th><b>Sr No.</b></th>
                  <th><b>User Id</b></th>
                  <th><b>Intern Name</b></th>
                  <th><b>Project </b></th>
                  <th><b>tech_skill</b></th>
                  <th><b>quality</b></th>
                  <th><b>attitude</b></th>
                  <th><b>punctuality</b></th>
                  <th><b>team_work</b></th>
                  <th><b>documentation</b></th>
                  <th><b>presentation</b></th>
                  <th><b>content</b></th>
                </thead>
                
                    <tbody>
                      @foreach($timeslot as $key=>$cur)
                      <tr>
                        <td><b>{{$key+1}}</b></td>
                        <td><b>{{$cur->userid}}</b></td>
                        <td><b>{{$cur->name}}</a></b></td>
                        <td><b>{{$cur->projectname}}</a></b></td>
                        <td><b>{{$cur->tech_skill}}</b></td>
                        <td><b>{{$cur->quality}}</b></td>
                        <td><b>{{$cur->attitude}}</b></td>
                        <td><b>{{$cur->punctuality}}</a></b></td>
                        <td><b>{{$cur->team_work}}</b></td>
                        <td><b>{{$cur->documentation}}</b></td>
                        <td><b>{{$cur->presentation}}</b></td>
                        <th><b>{{$cur->content}}</b></th>
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
