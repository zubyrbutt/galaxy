@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
@if(session('failed'))
    <script>
      $( document ).ready(function() {
        swal("Failed", "{{session('failed')}}", "error");
      });
      
    </script>
@endif
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Leads</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <table id="users-table" class="display responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>Lead No.</th>
                  <th>Created By</th>
                  <th>Created At</th>
                  <th>Customer Name</th>
                  <!--<th>Email</th>
                  <th>Phone Number</th>-->
                  <th>Business Name</th>
                  <th>Business Nature</th>
                  <th>Status</th>
				          <th>Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Lead No.</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Customer Name</th>
                    <!--<th>Email</th>
                    <th>Phone Number</th>-->
                    <th>Business Name</th>
                    <th>Business Nature</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->   

@endsection
@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('leads.data') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'createdby', name: 'createdby' },
            { data: 'created_at', name: 'created_at' },
            { data: 'user_id', name: 'user_id' },
            { data: 'businessName', name: 'businessName' },
            { data: 'businessNature', name: 'businessNature' },
            { data: 'status', name: 'status' },
            { data: 'status', name: 'status' }
        ]
    });
});
</script>
@endpush