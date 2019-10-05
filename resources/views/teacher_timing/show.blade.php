@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
<!-- some CSS styling changes and overrides -->
<style>
.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar {
    display: inline-block;
}
.kv-avatar .file-input {
    display: table-cell;
    width: 213px;
}
.kv-reqd {
    color: red;
    font-family: monospace;
    font-weight: normal;
}
</style>

    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Teacher Timing Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
            <div class="row"> 
              <div class="col-md-12">
              <table class="table table-striped">
                <tr>
                    <td width="25%"><b>Mon</b></td>
                    <td width="75%" style='color:green'><b>ON</b></td>
                </tr>
                <tr>
                    <td width="25%"><b>Tue</b></td>
                    <td width="75%" style='color:green'><b>ON</b></td>
                </tr>
                <tr>
                    <td width="25%"><b>Wed</b></td>
                    <td width="75%" style='color:green'><b>ON</b></td>
                </tr>
                <tr>
                    <td width="25%"><b>Thur</b></td>
                    <td width="75%" style='color:red'><b>OFF</b></td>
                </tr>
                <tr>
                    <td width="25%"><b>Fri</b></td>
                    <td width="75%" style='color:red'><b>OFF</b></td>
                </tr>
                <tr>
                    <td width="25%"><b>Sat</b></td>
                    <td width="75%" style='color:red'><b>OFF</b></td>
                </tr>

                <tr>
                    <td><b>Start Time</b></td>
                    <td>22:00</td>
                </tr>
                <tr>
                    <td><b>End Time</b></td>
                    <td>07:00</td>
                </tr>
                <tr>
                    <td><b>Teacher Name</b></td>
                    <td>Teacher {{ $id }}</td>
                </tr>
                <tr>
                    <td><b>Created At</b></td>
                    <td><?php echo date('d-m-Y')?></td>
                </tr>
                <tr>
                    <td><b>Updated At</b></td>
                    <td><?php echo date('d-m-Y')?></td>
                </tr>				
              </table>
                  

              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('/teacher_timing'); !!}" class="btn btn-default">Back</a>
              </div>
              <!-- /.box-footer -->
</div>
@endsection