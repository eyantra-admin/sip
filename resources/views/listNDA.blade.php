@extends('layouts.app', ['activePage' => 'listnda', 'titlePage' => __('List NDA')])

@section('content')
    <div class="content">
        <div class = "row">
            <div class="col-md-12" style="margin-top: 25px">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">NDA List</h4>
                  <p class="card-category"> List of all available NDA's</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table" id="listndatable" style="text-align: center;"> 
                    <thead class=" text-primary">
                      <th><b>Sr No.</b></th>
                      <th><b>Name</b></th>
                      <th><b>Email</b></th>
                      <th><b>project ID</b></th>
                       <th><b>project Name</b></th>
                      <th><b>Download</b></th>
                    </thead>
                        <tbody>
                          @foreach($list_ndas as $key=>$cur)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$cur->name}}</td>
                            <td>{{$cur->email}}</td>
                            <td>{{$cur->project_alloted}}</td>
                            <td>{{$cur->projectname}}</td>
                            <td> <a class="button" href="/download-nda/{{$cur->id}}">Download</a></td>
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