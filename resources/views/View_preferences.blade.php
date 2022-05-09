@extends('layouts.app', ['activePage' => 'viewpreferences', 'titlePage' => __('viewpreferences')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class = "row">
      <div class="col-md-12" style="margin-left: 20px">
        <button onclick="exportTableToCSV('ProjectPreferenceList.csv')" class="btn btn-primary"> Export to CSV File</button>  
      </div>


        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Student Project Preferences</h4>
              <p class="card-category"></p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="pref_table" style="text-align: center;"> 
                <thead class=" text-primary">
                  <th><b>Sr No.</b></th>
                  <th><b>User Id</b></th>
                  <th><b>Intern Name</b></th>
                  <th><b>Preference 1</b></th>
                  <th><b>Preference 2</b></th>
                  <th><b>Preference 3</b></th>
                  <th><b>Preference 4</b></th>
                  <th><b>Preference 5</b></th>
                </thead>
                    <tbody>
                      @foreach($preference as $key=>$cur)
                      <tr>
                        <td><b>{{$key+1}}</b></td>
                        <td><b>{{$cur->userid}}</b></td>
                         <td><b><a href="/ViewMyRegistration/{{Crypt::encrypt($cur->userid)}}" target="_blank">{{ $cur->name}}</a></b></td>
                        <td><b>{{$cur->P1name}}</b></td>
                        <td><b>{{$cur->P2name}}</b></td>
                        <td><b>{{$cur->P3name}}</b></td>
                        <td><b>{{$cur->P4name}}</b></td>
                        <td><b>{{$cur->P5name}}</b></td>
                        <!-- <td><a href="projectdetail/{{Crypt::encrypt($cur->id)}}" target="_blank">View Detail</a></td> -->
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
@endpush
