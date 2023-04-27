@extends('layouts.app', ['activePage' => 'prjPreferenceByPanel', 'titlePage' => __('Project Preference By Panel')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class = "row">
      <div class="col-md-12" style="margin-left: 20px">
        <button onclick="exportTableToCSV('projectPreferenceByPanel.csv')" class="btn btn-primary"> Export to CSV File</button>  
      </div>


        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">List of All Projects</h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="projectList_table"> 
                  <thead class="thead-dark">
                    <th scope="col"><b>Sr No.</b></th>
                    <!-- <th scope="col"><b>Project Id</b></th> -->
                    <th scope="col"><b>Project Name</b></th>
                    <th scope="col">Interns Required</th>
                    <th scope="col"><b>NumberOfIntern<br>AsPreference1</b></th>
                    <th scope="col"><b>NumberOfIntern<br>AsPreference2</b></th>
                    <th scope="col"><b>NumberOfIntern<br>AsPreference3</b></th>                    
                  </thead>
                
                  <tbody>
                      @foreach($projects as $key=>$cur)
                      <tr>
                        <td class="p-8"><b>{{$key+1}}</b></td>
                        <!-- <td><b>{{$cur->id}}</b></td> -->
                        <td><b>
                          <a href="mentorprojectdetail/{{Crypt::encrypt($cur->id)}}" target="_blank">
                            {{$cur->projectname}}
                          </a>  
                        </b></td>
                        <td><b>{{$cur->interns_required}}</b></td>
                        <td><b>{{$cur->p1_count}}</b></td>
                        <td><b>{{$cur->p2_count}}</b></td>
                        <td><b>{{$cur->p3_count}}</b></td>
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
     $('#projectList_table').DataTable(
      {
         // Sets the row-num-selection "Show %n entries" for the user
        "lengthMenu": [ 25, 50, 75, 100, 125,150, 175,200,250 ], 
        
        // Set the default no. of rows to display
        "pageLength": 50 
      });
    
  });

  
</script>
@endpush
