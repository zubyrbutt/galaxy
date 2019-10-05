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
              <h3 class="box-title">Schedule Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
            <div class="row"> 
              <div class="col-md-12">
              <table class="table table-striped">
                <tr>
                    <td><b>Due Date</b></td>
                    <td><?php echo date('d')?></td>
                </tr>
				<tr>
                    <td width="25%"><b>Student </b></td>
                    <td width="75%" >{{ $id }}</td>
                </tr>
				<tr>
                    <td width="25%"><b>Username </b></td>
                    <td width="75%" >{{ $id }}</td>
                </tr>
				<tr>
                    <td width="25%"><b>Password </b></td>
                    <td width="75%" >{{ $id }}</td>
                </tr>
				<tr>
                    <td width="25%"><b>Extension ID </b></td>
                    <td width="75%" >{{ $id }}</td>
                </tr>
				
				
				
				<tr>
                    <td width="25%"><b>Teacher</b></td>
                    <td width="75%" >{{ $id }}</td>
                </tr>
				<tr>
                    <td width="25%"><b>Course</b></td>
                    <td width="75%" >{{ $id }}</td>
                </tr>			
                <tr>
                    <td width="25%"><b>Start time</b></td>
                    <td width="75%" >09:00</td>
                </tr>
                <tr>
                    <td width="25%"><b>End time</b></td>
                    <td width="75%" >17:00</td>
                </tr>

				<tr>
                    <td width="25%"><b>Class Days</b></td>
                    <td width="75%" >Mon,Tues,Wed</td>
                </tr>
				
                <tr>
                    <td width="25%"><b>Status</b></td>
                    <td width="75%" >Regular</td>
                </tr>

				<tr>
                    <td><b>Parent</b></td>
                    <td>{{ $id }}</td>
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
                <a href="{!! url('/daily_schedule'); !!}" class="btn btn-default">Back</a>
              </div>
              <!-- /.box-footer -->
</div>
@endsection