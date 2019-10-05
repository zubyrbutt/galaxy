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
              <h3 class="box-title">Manage Parents</h3>
			  @can('create-parents')
              <span class="pull-right">
				<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default"><span class="fa fa-plus"></span> Add Parent</button>
              </span>
			  @endcan
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table_data" class="display responsive wrap" style="width:100%">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Status</th>
                  <th>Country</th>
				  <th>Ext Id</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               	  
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Status</th>
                  <th>Country</th>				  
				  <th>Ext Id</th>
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
	  
      <!-- Add Modal Begins 			ADD PARENT-->  	  
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add Parent</h4>
            </div>
            <div class="modal-body">
              <form role="form" action="{{url('/parents')}}" method="POST" id="frmAddDepartment">
                @csrf
                <div class="box-body">
                <div class="form-group">
                  <label for="fname" class="">First Name</label>
                    <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" autocomplete="off" value="{{ old('fname') }}" require >
                    @if ($errors->has('fname'))
                          <span class="text-red">
                              <strong>{{ $errors->first('fname') }}</strong>
                          </span>
                      @endif
                  
                </div>
                <div class="form-group">
                  <label for="lname" class="">Last Name</label>
                    <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" value="{{ old('lname') }}" autocomplete="off" require>
                    @if ($errors->has('lname'))
                          <span class="text-red">
                              <strong>{{ $errors->first('lname') }}</strong>
                          </span>
                      @endif
                </div>

                <div class="form-group">
                  <label for="email" class="">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off" require>
                    @if ($errors->has('email'))
                          <span class="text-red">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                </div>

                <div class="form-group">
                  <label for="password" class="">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" require>
                    @if ($errors->has('password'))
                          <span class="text-red">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                </div>


                <div class="form-group">
                  <label for="phonenumber" class="">Phone Number</label>
                    <input type="text" class="form-control" id="phonenumber" name="phonenumber" placeholder="Phone Number" value="{{ old('phonenumber') }}" autocomplete="off" require>
                    @if ($errors->has('phonenumber'))
                          <span class="text-red">
                              <strong>{{ $errors->first('phonenumber') }}</strong>
                          </span>
                      @endif
                </div>
				
				<div class="form-group">
					  <label for="countryID" class="">Country</label>
							<select id="countryID" name="countryID" class="form-control m-bot15">
							@if ($country_list!='')
								@foreach($country_list as $key => $country)
								<option value="{{ $key }}" >{{ $country }}</option>							
								@endforeach
							@endif
							</select>
							@if ($errors->has('countryID'))
							  <span class="text-red">
								  <strong>{{ $errors->first('countryID') }}</strong>
							  </span>
							@endif
				</div>				

	
                </div>
                <!-- /.box-body -->
  
                <div class="box-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  <span class="pull-right"><button type="submit" class="btn btn-primary">Submit</button></span>
                </div>
              </form>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <!-- Add Modal Ends -->  
	  
	  
	  
	  
	  
	  
	  
	  
	  

      <!-- Edit Modal Begins -->   
      <div class="modal fade" id="modal-default-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Parent</h4>
              </div>
              <div class="modal-body">
                <form role="form" action="{{route('parents.update')}}" method="POST" id="frmEditDepartment">
                  @csrf
                  <input name="_method" type="hidden" value="PATCH">
                  <input name="id" id="editid" type="hidden" value="0">
                  <div class="box-body">
                <div class="form-group">
                  <label for="fname" class="">First Name</label>
                    <input type="text" class="form-control" id="editfname" name="fname" placeholder="First Name" autocomplete="off" value="{{ old('fname') }}" require >
                    @if ($errors->has('fname'))
                          <span class="text-red">
                              <strong>{{ $errors->first('fname') }}</strong>
                          </span>
                      @endif
                  
                </div>
                <div class="form-group">
                  <label for="lname" class="">Last Name</label>
                    <input type="text" class="form-control" id="editlname" name="lname" placeholder="Last Name" value="{{ old('lname') }}" autocomplete="off" require>
                    @if ($errors->has('lname'))
                          <span class="text-red">
                              <strong>{{ $errors->first('lname') }}</strong>
                          </span>
                      @endif
                </div>

                <div class="form-group">
                  <label for="email" class="">Email</label>
                    <input type="email" class="form-control" id="editemail" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off" require>
                    @if ($errors->has('email'))
                          <span class="text-red">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                </div>

                <div class="form-group">
                  <label for="phonenumber" class="">Phone Number</label>
                    <input type="text" class="form-control" id="editphonenumber" name="phonenumber" placeholder="Phone Number" value="{{ old('phonenumber') }}" autocomplete="off" require>
                    @if ($errors->has('phonenumber'))
                          <span class="text-red">
                              <strong>{{ $errors->first('phonenumber') }}</strong>
                          </span>
                      @endif
                </div>				
				
				<div class="form-group">
				  <label for="extension" class="">Extension</label>

				  <input type="text" class="form-control" id="editextension_id" name="extension_id" placeholder="Dialer ID" value="{{ old('ext_id') }}" autocomplete="off" require>
                  	
				  @if ($errors->has('extension_id'))
						  <span class="text-red">
							  <strong>{{ $errors->first('extension_id') }}</strong>
						  </span>
					  @endif
				</div>		
				
				<div class="form-group">
					  <label for="countryID" class="">Country</label>
							<select id="editcountryID" name="countryID" class="form-control">
							@if ($country_list!='')
								@foreach($country_list as $key => $country)
								<option value="{{ $key }}" >{{ $country }}</option>							
								@endforeach
							@endif
							</select>
				</div>					
					
					
					
                  </div>
                  <!-- /.box-body -->
    
                  <div class="box-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <span class="pull-right"><button type="submit" class="btn btn-primary">Submit</button></span>
                  </div>
                </form>
              </div>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
        <!-- Edit Modal Ends -->  
		


        <!-- Show and Action Modal Begins -->   
      <div class="modal fade" id="modal-default-show">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body" id="showParentDetails">
             
            </div>
                <!-- /.box-body -->
  
                <div class="box-footer">
                  <span class="pull-right">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  </span>
                </div>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->

		
		
        <!-- Invoice and Action Modal Begins -->   
      <div class="modal fade" id="modal-default-show-invoice">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body" id="showParentInvoiceDetails">
             123123
            </div>
                <!-- /.box-body -->
  
                <div class="box-footer">
                  <span class="pull-right">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                  </span>
                </div>
            </div>
            
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->		
		
		
      <div class="loading">
        <div class="loader"></div>
      </div>
@endsection
@push('scripts')
<style>
.loading{
    display: hidden;
    position: fixed;
    left: 0;
    top: 0;
    padding-top: 45vh;
    padding-left:100vh;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background-color: gray;
    opacity: 0.8;
}
.loader {
  border: 16px solid #f3f3f3; /* Light grey */
  border-top: 16px solid #3498db; /* Blue */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
//Fetch Data Begins
  function InitTable() {
    $(".loading").fadeIn();
        $('#table_data').DataTable({
        "bDestroy": true,
        "processing": true,
        "serverSide": true,
        "Paginate": true,
        "order": [[1, 'desc']],
        "pageLength": 25,
        "ajax":{
                  "url": "{{ route('parents.fetch') }}",
                  "dataType": "json",
                  "type": "POST",
                  "data":{ _token: "{{csrf_token()}}"}
                },
        "columns": [
            { "data": "id" },
            { "data": "fullname" },
            { "data": "email" },
            { "data": "phonenumber" },
            { "data": "status" },
            { "data": "countryID" },
			{ "data": "ext_id" },
            { "data": "options" ,"orderable":false},
        ]  

    });     
}
//Fetch Data Ends

$(document).ready(function (e) {
  InitTable();
 $(".loading").fadeOut();
 //Add Department Begins
  $("#frmAddDepartment").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{url('/parents')}}",
         type: "POST",
         data:  new FormData(this),
         contentType: false,
         cache: false,
         processData:false,
          beforeSend : function()
          {
            $(".loading").fadeIn();
          },
          statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
          success: function(data)
            {
                if(data.errors)
                {
                  $(".loading").fadeOut();                
                  var errordetails="";
                  if(data.errors.fname){
                    errordetails+=data.errors.fname+ "\n";
                  }
                  if(data.errors.lname){
                    errordetails+=data.errors.lname+ "\n";
                  }
                  if(data.errors.email){
                    errordetails+=data.errors.email+ "\n";
                  }
                  if(data.errors.password){
                    errordetails+=data.errors.password+ "\n";
                  }
				  if(data.errors.phonenumber){
                    errordetails+=data.errors.phonenumber+ "\n";
                  }
				  if(data.errors.countryID){
                    errordetails+=data.errors.countryID+ "\n";
                  }

                  swal("Failed", "Unable to Create new Parent.\n " + errordetails , "error");
                }
                else
                {
					var parent_id=data.parent_id;
					var output_dialer=data.output_dialer;
					
                  $('#modal-default').modal('toggle');
                  $("#frmAddDepartment")[0].reset(); 
				  if(output_dialer=='ERROR'){
					swal("Failed", "Parent Cannot be created  - Api Hit UnSuccessful.", "error");
					//window.location = "{{ url('parents/') }}";  
				  }
				  else{
                  swal("Success", "Parent created successfully.", "success");
				  window.location = "{{ url('parents/studentformparent') }}/"+parent_id;
				  }
                  //InitTable();
                  //$(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to Create Parent, Please try again later.", "error");
              }          
       });
    }));
  //Add Department Ends
  //Edit Department Form Begins
    $(document).on('click', '.edit', function()
    {
	  //alert('123');
      var id = $(this).attr('data-id');
      $.ajax({
        "url": "{{route('parents.edit')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        beforeSend : function()
        {
          $(".loading").fadeIn();
        },
        statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
        success: function(data)
        {
          $(".loading").fadeOut();
          //Populating Form Data to Edit Begins
          $('#modal-default-edit').modal('toggle');
          $('#editid').val(data.id);
          $('#editfname').val(data.fname);
          $('#editlname').val(data.lname);
		  $('#editemail').val(data.email);
		  $('#editphonenumber').val(data.phonenumber);
		  $('#editextension_id').val(data.parentdetail_relation.ext_id);
		  //$('#editcountryID').val(data.parentdetail_relation.countryID)='';
		  $('#editcountryID').val(data.parentdetail_relation.countryID);		  
		  //Populating Form Data to Edit Ends
        },
          error: function(){},          
      });
    });
  //Edit Department Form Ends
  //Update Department Begins
  $("#frmEditDepartment").on('submit',(function(e) {
  e.preventDefault();
  $.ajax({
         url: "{{route('parents.update')}}",
         type: "POST",
         data:  new FormData(this),
         contentType: false,
         cache: false,
         processData:false,
          beforeSend : function()
          {
            $(".loading").fadeIn();
          },
          statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
          success: function(data)
            {
              
                if(data.errors)
                {
                  $(".loading").fadeOut();
                  var errordetails="";
                  if(data.errors.fname){
                    errordetails+=data.errors.fname+ "\n";
                  }
                  if(data.errors.lname){
                    errordetails+=data.errors.lname+ "\n";
                  }
                  if(data.errors.email){
                    errordetails+=data.errors.email+ "\n";
                  }
                  if(data.errors.password){
                    errordetails+=data.errors.password+ "\n";
                  }
				  if(data.errors.phonenumber){
                    errordetails+=data.errors.phonenumber+ "\n";
                  }
				  if(data.errors.countryID){
                    errordetails+=data.errors.countryID+ "\n";
                  }				  
				  if(data.errors.extension_id){
                    errordetails+=data.errors.extension_id+ "\n";
                  }				  
                  swal("Failed", "Unable to update parent, " + data.errors.deptname , "error");
                }
                else
                {
                  $('#modal-default-edit').modal('toggle');
                  $("#frmEditDepartment")[0].reset(); 
                  swal("Success", "Parent updated successfully js.", "success");
                  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to Update parent, Please try again later.", "error");
              }          
       });
    }));
    //Update Department Ends

    //Change Department Status Begins
    $(document).on('click', '.status', function()
    {
      swal({
        title: "Are you sure want to change the status?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          var id = $(this).attr('data-id');
          var action = $(this).attr('data-action');
          if(action==0){
              url="{{url('/settings/department/deactivate/')}}";
          }else{
              url="{{url('/settings/department/active/')}}";
          }
          $.ajax({
            "url":url,
            type: "POST",
            data: {'id': id,_token: '{{csrf_token()}}'},
            dataType : "json",
            beforeSend : function()
            {
              $(".loading").fadeIn();
            },
            statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
           },
            success: function(data)
            {
              $(".loading").fadeOut();
              swal("Success", "Department status updated successfully.", "success");
              InitTable();
              $(".loading").fadeOut();
              //Populating Form Data to Edit Ends
            },
              error: function(){
                $(".loading").fadeOut();
                swal("Failed", "Unable to update department status." , "error");
              },          
          });
        } 
      });

    });
    //Change Department Status Ends

    //Delete Department Begins
    $(document).on('click', '.delete', function(e)
    {
      swal({
        title: "Are you sure to delete?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          var id = $(this).attr('data-id');  
          var token= '{{csrf_token()}}';
              e.preventDefault();
              
              var request_method = $("#form"+id).attr("method"); 
              var form_data = $("#form"+id).serialize(); 
              
              $.ajax({
                url: "department/delete/"+id,
                type: request_method,
                dataType: "JSON",
                data: form_data,
                beforeSend : function()
                {
                  $(".loading").fadeIn();
                },
                statusCode: {
                  403: function() {
                    $(".loading").fadeOut();                
                    swal("Failed", "Permission deneid for this action." , "error");
                    return false;
                  }
                },
                success: function(data)
                {
                  $(".loading").fadeOut();
                  swal("Success", "Department delete successfully.", "success");
                  var table = $('#table_data').DataTable();
                  table
                  .row( $(this).parents('tr') )
                  .remove()
                  .draw();

                  $(".loading").fadeOut();
                },
                  error: function(){
                    $(".loading").fadeOut();
                    swal("Failed", "Unable to delete department." , "error");
                  },          
              });
          
        } 
      });

    });
    //Delete Department Ends
	
	
	
	
	
	
//Show Parents Form Begins
$(document).on('click', '.showparent', function()
    {
		//alert('show parents');
      var id = $(this).attr('data-id');
      $.ajax({
        "url": "{{route('parents.show')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        
        beforeSend : function()
        {
          $(".loading").fadeIn();
        },
        statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
        success: function(data)
        {
          $(".loading").fadeOut();
          $('#modal-default-show').modal('toggle');
          $('#showParentDetails').html(data);
          //Populating Form Data to Edit Begins
          /*$('#modal-default-show').modal('toggle');
          $('#showid').val(data.id);
          $('#showname').val(data.name);
          $('#showemail').val(data.email);
          $('#showmobile').val(data.mobile);
          $('#showdepartment_id').val(data.department_id);*/
          //Populating Form Data to Edit Ends
        },
          error: function(){},          
      });
    });
  //Show Parents Form Ends	
	
    //Change Department Status Begins
    $(document).on('click', '.status', function()
    {
      swal({
        title: "Are you sure want to change the status?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          var id = $(this).attr('data-id');
          var action = $(this).attr('data-action');
          if(action==2){
              url="{{url('/parents/deactivate/')}}";
          }else{
              url="{{url('/parents/active/')}}";
          }
          $.ajax({
            "url":url,
            type: "POST",
            data: {'id': id,_token: '{{csrf_token()}}'},
            dataType : "json",
            beforeSend : function()
            {
              $(".loading").fadeIn();
            },
            statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
           },
            success: function(data)
            {
              $(".loading").fadeOut();
              swal("Success", "Parent status updated successfully.", "success");
              InitTable();
              $(".loading").fadeOut();
              //Populating Form Data to Edit Ends
            },
              error: function(){
                $(".loading").fadeOut();
                swal("Failed", "Unable to update department status." , "error");
              },          
          });
        } 
      });

    });	


//Show INVOICE Form Begins
$(document).on('click', '.showparentInvoice', function()
    {
		//alert('show parents');
      var id = $(this).attr('data-id');
      $.ajax({
		//Add parents dot showinvoice URL later here 
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        
        beforeSend : function()
        {
          $(".loading").fadeIn();
        },
        statusCode: {
            403: function() {
              $(".loading").fadeOut();                
              swal("Failed", "Permission deneid for this action." , "error");
              return false;
            }
          },
        success: function(data)
        {
          $(".loading").fadeOut();
          $('#modal-default-show-invoice').modal('toggle');
          $('#showParentInvoiceDetails').html(data);
          //Populating Form Data to Edit Begins
          /*$('#modal-default-show').modal('toggle');
          $('#showid').val(data.id);
          $('#showname').val(data.name);
          $('#showemail').val(data.email);
          $('#showmobile').val(data.mobile);
          $('#showdepartment_id').val(data.department_id);*/
          //Populating Form Data to Edit Ends
        },
          error: function(){},          
      });
    });
  //Show INVOICE Form Ends	
	

  });
  

</script>
@endpush