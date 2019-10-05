@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
        InitTable();
        $('#myModal').hide();
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
<script type="text/javascript">
  $( document ).ready(function() {


    $('.select2').select2({
          placeholder: "Option Select",
          multiple: false,
      }); 
});
</script>
<style type="text/css">
  .form-horizontal .form-group {
     margin-right: 0px; 
     margin-left: 0px; 
}
</style>
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" enctype="multipart/form-data">
          @csrf
        <div class="box box-success collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">Advance Filter</h3>            
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="display: none;">
            
            <!--Search Form Begins -->
            <div class="row col-md-12">
                <div class="form-group col-md-6">
                  <label>Name</label>
                  <input type="text" name="name" id="filter_name" class="form-control">
                {{--  <select name="name" id="filter_name" class="form-control select2 select2-hidden-accessible" data-placeholder="Option Select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                  <option value="">Choose Option</option>
                  @foreach($data['name'] as $row)
                    <option value="{{$row->name}}">{{$row->name}}</option>
                  @endforeach                
                </select>--}}
                </div>
                <div class="form-group col-md-6">
                    <label>Contact No</label>
                    <input type="text" name="contactno" id="filter_contactno" class="form-control">
                   {{-- <select name="contactno" id="filter_contactno" class="form-control select2 select2-hidden-accessible" data-placeholder="Option Select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                      <option value="">Choose Option</option>
                      @foreach($data['contactno'] as $row)
                        <option value="{{$row->contactno}}">{{$row->contactno}}</option>
                      @endforeach                
                    </select>--}}
                </div>
            </div>

            <div class="row col-md-12">
                <div class="form-group col-md-6">
                  <label>Country</label>
                  <select name="country" id="filter_country" class="form-control select2 select2-hidden-accessible" data-placeholder="Option Select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="">Choose Option</option>
                        @foreach($data['country'] as $row)
                          <option value="{{$row->country}}">{{$row->country}}</option>
                        @endforeach                
                  </select>
                </div>
                <div class="form-group col-md-6">
                    <label>Subject</label>
                    <select name="subject" id="filter_subject" class="form-control select2 select2-hidden-accessible" data-placeholder="Option Select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                          <option value="">Choose Option</option>
                          @foreach($data['subject'] as $row)
                            <option value="{{$row->subject}}">{{$row->subject}}</option>
                          @endforeach                
                    </select>
                </div>
            </div>

            <div class="row col-md-12">
                <div class="form-group col-md-6">
                  <label>status</label>
                  <select name="status" id="filter_status" class="form-control select2 select2-hidden-accessible" data-placeholder="Option Select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                          <option value="">Choose Option</option>
                            <option value="0">New</option>
                            <option value="2">Closed</option>
                            <option value="3">Rejected</option>
                            <option value="4">Not Interested</option>                
                            <option value="5">Call Back</option>
                            <option value="6">Trial Committed</option>
                            <option value="7">Trial Delivered</option>
                            <option value="8">Invoice Sent</option>
                            <option value="9">Spam</option>
                            <option value="10">NSNC</option>                
                  </select>
                </div>

                 <div class="form-group col-md-6">
                  <label>refcode</label>
                  <select name="refcode" id="filter_refcode" class="form-control select2 select2-hidden-accessible" data-placeholder="Option Select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                          <option value="">Choose Option</option>
                          @foreach($data['refcode'] as $row)
                            <option value="{{$row->refcode}}">{{$row->refcode}}</option>
                          @endforeach                
                  </select>
                </div>

                
            </div>
            <div class="row col-md-12">
               <div class="form-group col-md-12">
                  <label>Select Date Range:</label>
                  <div class="input-group">
                    <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                      <span>{{date('F d, Y')}} - {{date('F d, Y')}}</span>
                      <input type="hidden" name="dateFrom" id="dateFrom" value="{{date('Y-m-d')}}">
                      <input type="hidden" name="dateTo" id="dateTo" value="{{date('Y-m-d')}}">
                      <i class="fa fa-caret-down"></i>
                    </button>
                  </div>
                </div>
            </div>
            <!-- Search Form Ends -->
          </div>




          <!-- /.box-body -->
          <div class="box-footer clearfix">
              <button type="submit" class="pull-right btn btn-primary" id="filterRecords">Search
                <i class="fa fa-search"></i></button>
              <button type="submit" class="pull-right btn btn-primary" style="margin-right: 20px;" id="filterClear">Clear Filter
                </button>
          </div>
        </div>
        <!-- /.box -->
      </form>
      </div>
</div>

<div class="row">
    <div class="col-md-12">
  
        <div class="box box-success collapsed-box">
          <div class="box-header with-border">
            <h3 class="box-title">All Status Count</h3>            
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
              </button>
            </div>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body" style="display: none;">




        <div class="row">
          <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-object-group"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Leads</span>
              <span class="info-box-number">{{$data['Total_leads']}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-hourglass-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">New</span>
              <span class="info-box-number">{{$data['New']}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">In Process</span>
              <span class="info-box-number">{{$data['Inprocess']}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-file-audio-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Call back</span>
              <span class="info-box-number">{{$data['Callback']}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
         <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

         <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Trial Committed</span>
              <span class="info-box-number">{{$data['TrialCommitted']}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-4 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-file-audio-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Trial Delivered</span>
              <span class="info-box-number">{{$data['TrialDelivered']}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
</div>



          </div>
          <!-- /.box-body -->
         
        </div>
        <!-- /.box -->
      </div>
</div>

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Leads</h3>
              <span class="pull-right">
                  <a href="{!! url('getleads'); !!}" class="btn btn-info">Fetch New Leads</a>
                  <a href="{!! url('yccleads/create'); !!}" class="btn btn-success">Add New Lead</a>
              </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive" >
            
              <table id="table_data" class="display" style="width:100%">
                <thead>
                <tr>
                  <th>Lead No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contct No</th>
                  <th>Country</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Status</th>
                  <th>Lead Date</th>
                  <th>Ref Code</th>
                  <th>Action</th>
				          
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>Lead No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Contct No</th>
                  <th>Country</th>
                  <th>Subject</th>
                  <th>Message</th>
                  <th>Status</th>
                  <th>Lead Date</th>
                  <th>Ref Code</th>
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

<style>
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1111; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto; /* 15% from the top and centered */
    padding: 2px;
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
    color: black;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

/* Modal Header */
.modal-header {
    padding: 2px 8px;

}


/* Modal Footer */
.modal-footer {
    padding: 2px 8px;
}


</style>

<!-- The Modal -->
<div id="myModal" class="modal">
<form action="{{ url('yccleadstatus')}}" method="POST" id="yccleads">
  @csrf
  <!-- Modal content -->
<div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h2 id="modalheader">Your Cloud Campus Leads</h2>
    </div>
    <div class="modal-body" id="modalbody">
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" id="name" class="form-control" value="" readonly>
        </div>
        <div class="form-group">
            <label>Contact No</label>
            <input type="text" name="contactno" id="contactno" class="form-control" value="" readonly>
        </div>
        <div class="form-group">
            <label>Subject</label>
            <input type="text" name="subject" id="subject" class="form-control" value="" readonly>
        </div>
        <div class="form-group">
            <label>Country</label>
            <input type="text" name="country" id="country" class="form-control" value="" readonly>
        </div>
        <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status" id="status">
                <option value="1" selected>Inprocess</option>
                <option value="2">Closed</option>
                <option value="3">Rejected</option>
                <option value="4">Not Interested</option>                
                <option value="5">Call Back</option>
                <option value="6">Trial Committed</option>
                <option value="7">Trial Delivered</option>
                <option value="8">Invoice Sent</option>
                <option value="9">Spam</option>
                <option value="10">NSNC</option>
                
              </select>

             
        </div>
        <div class="form-group">
            <label>Message</label>
            <textarea class="form-control" rows="3" placeholder="Enter ..." name="notes" id="notes" required></textarea>
        </div>
      
    </div>
    <div class="modal-footer" id="modalfooter">
        <input type="hidden" name="yccleadid" id="yccleadid" class="form-control" value="" readonly>
      <input type="submit" class="btn btn-primary" id="btn-update" value="Update">
    </div>
  </div>
</form>
</div>



<!-- Modal for mail -->

<!-- Modal -->
  <div class="modal fade" id="mail" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Email</h4>
        </div>
            <form action="{{ url('email.save')}}" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                    
                        <div class="form-group">
                            <label>Select E-mail</label>
                            
                            <select class="form-control" name="title" id="title" onchange="Title(this.value)">
                              @foreach($data['emails']  as $row)
                                <option value="{{$row->id}}">{{$row->title}}</option>
                              @endforeach   
                              </select>
                             
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="subject" id="subject_email" class="form-control" value="" >
                        </div>

                        <div class="form-group">
                            <label>Email Body</label>
                           <textarea id="editor1" class="body_email" name="body" rows="10" cols="80" required>
                            </textarea>
                        </div>
                </div>
                    <div class="modal-footer">
                      <input type="hidden"  id="email_id" name="email_id" value="">
                      <input type="submit" class="btn btn-primary" id="btn-update" value="Send Mail">
                    </div>   
            </form>
  </div>
      
    </div>
  </div>



<!-- modal end -->

@endsection
@push('scripts')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
 <script src="{{ asset('bower_components/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>
<link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <link href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">

<script type="text/javascript">
  var InitTable = function() {
   
  $('#table_data').DataTable({
            "bDestroy": true,
            "processing": true,
            "serverSide": true,
            "Paginate": true,
             
            "ajax":{
                     "url": "{{ route('yccleads.fetch') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "email" },
                { "data": "contactno" },
                { "data": "country" },
                { "data": "subject" },
                { "data": "message" },
                { "data": "status" },
                { "data": "created_at" },
                { "data": "refcode" },
                { "data": "options" },
            ]  

        });

    // jQuery('#table_data .dataTables_td input').addClass(""); // modify table search input
        //jQuery('#trulie_data .dataTables_length select').addClass("form-control input-xsmall"); // modify table per page dropdown
        //jQuery('#trulie_data .dataTables_length select').select2(); // initialize select2 dropdown
}

$( document ).ready(function() {

  InitTable();
 
});
</script>
<script>
 $('.clearfix').on('click', '#filterRecords', function () {
       var name         =    $('#filter_name').val();
       var contactno    =    $('#filter_contactno').val();
       var subject      =    $('#filter_subject').val();
       var country      =    $('#filter_country').val();
       var refcode      =    $('#filter_refcode').val();
       var status       =    $('#filter_status').val();
       var dateFrom     =    $('#dateFrom').val();
       var dateTo       =    $('#dateTo').val();
    event.preventDefault();  
   $.ajax({
            url: "{{url('getYccLeadFilterData')}}",
            type: "POST",
            data: {'name': name,_token:'{{csrf_token()}}','contactno':contactno,'subject':subject,'country':country,'refcode':refcode,'status':status,'dateFrom':dateFrom,'dateTo':dateTo},
            dataType : "json",
            success: function(data){
              InitTable();
    },
    error: function(){},          
    });
});

 $('.clearfix').on('click', '#filterClear', function () { 
   event.preventDefault(); 
  InitTable();
});

 $(document).on('click', '.edit-modal', function() {
           var id = $(this).attr('data-id');
        $.ajax({
                url: "{{url('getYccLeadData')}}",
                type: "POST",
                data: {'id': id,_token:'{{csrf_token()}}'},
                dataType : "json",
                success: function(data){
                  $('#name').val(data.name);
                  $('#yccleadid').val(data.id);
                  $('#contactno').val(data.contactno);
                  $('#subject').val(data.subject);
                  $('#country').val(data.country);
                  $('#myModal').modal('show');
        },
        error: function(){},          
        });
});


$(function() {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
});

function Title(id){
        $.ajax({
          url: "{{url('getEmail')}}",
          type: "POST",
          data: {'id': id,_token:'{{csrf_token()}}'},
          dataType : "json",
          success: function(data){
            console.log(data[0].subject);
            $("#subject_email").val(data[0].subject);
            CKEDITOR.instances['editor1'].setData(data[0].body);
          },
          error: function(){},          
        });
}


// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];


$(function() {
    /*var table=$('#users-table').DataTable({
        processing: true,
        pageLength: 100,
        serverSide: true,

        ajax: '{!! route('yccleads.data') !!}',
        order: [[ 8, "desc" ]],


        columns: [
           
            { data: 'id', name: 'id'},
            { data: 'name', name: 'namme' },
            { data: 'email', name: 'email' },
            { data: 'contactno', name: 'contactno' },
            { data: 'country', name: 'country' },
            { data: 'subject', name: 'subject' },
            { data: 'message', name: 'message' },
            { data: 'status', name: 'status' },
            { data: 'created_at', name: 'created_at' },
            { data: 'refcode', name: 'refcode' },
            {"defaultContent": '<button class="btn btn-primary"><i class="fa fa-bolt"></i></button> <button class="btn btn-info"><i class="fa fa-eye"></i></button><button class="btn btn-warning" data-toggle="modal" data-target="#mail"><i class="fa fa-mail-forward"></i></button>'}  
            


        ],
        
        columnDefs : [
        { targets : [7],
          render : function (data, type, row) {
            switch(data) {
               case '0' : return '<span class="btn btn-block btn-info btn-flat">New</span>'; break;
               case '1' : return '<span class="btn btn-block btn-warning btn-flat">Inprocess</span>'; break;
               case '2' : return '<span class="btn btn-block btn-success btn-flat">Closed</span>'; break;
               case '3' : return '<span class="btn btn-block btn-danger btn-flat">Rejected</span>'; break;
               case '4' : return '<span class="btn btn-block btn-danger btn-flat">Not Interested</span>'; break;
               case '5' : return '<span class="btn btn-block btn-primary btn-flat">Call back</span>'; break;
               case '9' : return '<span class="btn btn-block btn-danger btn-flat">Spam</span>'; break;
               default  : return '<span class="btn btn-block btn-info btn-flat">New</span>';
            }
          }
        },
        ],
        rowCallback: function(row, data, index) {
          if (data.status == "0") {
            //$("td:eq(7)", row).addClass("");
          }
        }
    });

*/
  $('#table_data tbody').on( 'click', '.btn-warning', function () {
          var row  = $(this).parents('tr')[0];
          var tdata=table.row( row ).data();
          //console.log(tdata.id );
          $('#email_id').val(tdata.email);
          //modal.style.display = "block";
          $('#mail').modal('show');
    } );


   /* $('#table_data tbody').on( 'click', '.btn-primary', function () {
          var row  = $(this).parents('tr')[0];
          var tdata=table.row( row ).data();
          console.log(tdata.id );
          $('#name').val(tdata.name);
          $('#contactno').val(tdata.contactno);
          $('#subject').val(tdata.subject);
          $('#country').val(tdata.country);
          
          
          modal.style.display = "block";
    } );
  
    $('#table_data tbody').on( 'click', '.btn-primary', function () {
          var row  = $(this).parents('tr')[0];
          var tdata=table.row( row ).data();
          console.log(tdata.id );
          $('#yccleadid').val(tdata.id);
          $('#name').val(tdata.name);
          $('#contactno').val(tdata.contactno);
          $('#subject').val(tdata.subject);
          $('#country').val(tdata.country);        
          modal.style.display = "block";
    } );
 
    $('#table_data tbody').on( 'click', '.btn-info', function () {
          var row  = $(this).parents('tr')[0];
          var tdata=table.row( row ).data();
          console.log(tdata.id );
          window.location = "{{ url('yccleads/')}}/"+tdata.id;
    } );
    */

});


// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


$(function() {

$('#btn-update').on('click', function(e) {
    e.preventDefault();
    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        type: "POST",
        url: "{{ url('yccleadstatus') }}",
        data: $('#yccleads').serialize(),
        success: function(response) {
          if(response.errors)
          {
            swal("Failed", "All fields are required, Please fill the detail before submitting.", "error");
          }
          else
          {
            $('#yccleads').trigger("reset");
            swal("Success", "Status updated successfully.", "success");
            InitTable();
            $('#myModal').modal('hide');		
          }
            
        }
    });
    return false;
});
});


</script>


<script>
                
 $(document).ready(function() { 
  $('.select2').select2({
      placeholder: "Select Staff",
      multiple: false,
  }); 
  //Date range as a button
  $('#daterange-btn').daterangepicker(

    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      $('#dateFrom').val(start.format('YYYY-MM-DD'));
      $('#dateTo').val(end.format('YYYY-MM-DD'));
    }
  );

  });
</script>
@endpush