
<!-- Widget: user widget style 1 -->
	<div class="box box-widget widget-user">
	  <!-- Add the bg color to the header using any of the bg-* classes -->
	  <div class="widget-user-header bg-aqua-active">
		<h3 class="widget-user-username">{{$parents['fname']}} {{$parents['lname']}}</h3>
		<h5 class="widget-user-desc"></h5>
	  </div>
	  <div class="widget-user-image">
		<img class="img-circle" src="{{asset('img/default_avatar_male.jpg')}}" alt="User Avatar">
	  </div>
	  <div class="box-footer">
		<div class="row">
		  <div class="col-sm-12">
			<div class="description-block">
			  <h5 class="description-header">{{$parents['phonenumber']}}</h5>
			  <span class="description-text">{{$parents['email']}}</span><br>
			  <span class="description-text"><b>EXT ID: </b>{{$parents->parentdetail_relation['ext_id']}}</span>
			</div>
			<!-- /.description-block -->
		  </div>
		</div>
		<!-- /.row -->
	  </div>
	</div>
	<!-- /.widget-user -->
	<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Student Details</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed responsvie" id="statustable">
                <tbody>
				<tr>
                  <th>Name</th>
				  <th>Username</th>
				  <th>Extension Id</th>
				  <th>Paydate</th>
				  <th>Created by</th>
				  <th>Created at</th>
				  <th>Updated at</th>
				</tr>
				@foreach ($student_details as $student_detail)
				<tr>
				  <td>{{$student_detail['fname']}} {{$student_detail['lname']}}</td>
				  <td>{{$student_detail['email']}}</td>
				  <td>{{$parents->parentdetail_relation['ext_id']}}</td>
				  <td>{{$student_detail->student_paydate['paydate']}} </td>				  
				  <td>{{$student_detail->createdby_self['fname']}} {{$student_detail->createdby_self['lname']}}</td>
				  <td>{{$student_detail['created_at']->format('d-m-Y')}}</td>
				  <td>{{$student_detail['updated_at']->format('d-m-Y')}}</td>
				  
				</tr>
				@endforeach
			  </tbody>
			</table>
            </div>
			<!-- /.box-body -->
          </div>

		  
		  
<div class="row">
<!-- Address book, Email 	START -->
<div class="col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Customer Email</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
        
                    <table class="table table-bordered" id="TblProjectLinks">
                        <tbody><tr>
                          <th>Email</th>
                          <th>Action</th>
                        </tr>
                        <tr>
                            <td><input type="email" name="txtemail" id="txtemail" placeholder="Enter Email" class="form-control"></td>
                            <td><button class="btn btn-success" id="btnAddLink"><li class="fa fa-plus"></li></button><span id="IDlinkadding"></span></td>
                        </tr>	
                        @if(count($addressbooks) > 0)
                        @foreach($addressbooks as $addressbook)
                            <tr id="MyLinks_{{$addressbook->id}}">
                              <td>{{$addressbook->email}}</td>
                              <td><button class="btn btn-danger" id="btnDeleteLink" data-notif-id="MyLinks" data-id="{{$addressbook->id}}"><li class="fa fa-trash"></li></button></td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix" style="">
                    <div class="pull-right">
                    </div>
                </div>
                <!-- /.box-footer -->
        </div>
        </div>
        <!-- Address book, Email 	END  -->
        
        
        <!-- Address book, Phone 	START -->
        <div class="col-md-6">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Customer Phone</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
        
                    <table class="table table-bordered" id="TblProjectLinksPhone">
                        <tbody><tr>
                          <th>Phone</th>
                          <th>Action</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="txtphone" id="txtphone" placeholder="Enter Phone" class="form-control"></td>
                            <td><button class="btn btn-success" id="btnAddLinkPhone"><li class="fa fa-plus"></li></button><span id="IDlinkadding"></span></td>
                        </tr>	
                        @if(count($addressbooksphone) > 0)
                        @foreach($addressbooksphone as $addressbookphone)
                            <tr id="MyLinks_{{$addressbookphone->id}}">
                              <td>{{$addressbookphone->phone}}</td>
                              <td><button class="btn btn-danger" id="btnDeleteLink" data-notif-id="MyLinks" data-id="{{$addressbookphone->id}}"><li class="fa fa-trash"></li></button></td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                    
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix" style="">
                    <div class="pull-right">
                    </div>
                </div>
                <!-- /.box-footer -->
        </div>
        </div>
        <!-- Address book, Phone END  -->
</div>		  
		  
        <script>
        //Add Address book Begins //EMAIL
        $('#btnAddLink').click(function () {
        
        var txtEmail   = $("#txtemail").val();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
           url: "/addressbook",
           type: "POST",
           data:  {'email': txtEmail, 'user_id': {{$parents->id}}},
           beforeSend : function()
           {
            //$("#preview").fadeOut();
            //$("#err").fadeOut();
           },
           success: function(data)
           {
                    
                if(data.errors)
                {
                    
                    swal("Failed", "All fields are required, Please fill the detail before submitting.", "error");
                }
                else
                {
                    $("#txtemail").val("");
                    $('#TblProjectLinks tr:last').after(data.messages);
                    swal("Success", "Added successfully.", "success");		
                }
            },
                complete: function() {
                    $('#loader').hide();
            }
        });
        
        return false;
        });
        //Add Address book Ends
        
        //Delete Address book Ends //EMAIL
        
        
        //Add Address book Begins //PHONE
        $('#btnAddLinkPhone').click(function () {
        
        var txtPhone   = $("#txtphone").val();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
           url: "/addressbookphone",
           type: "POST",
           data:  {'phone': txtPhone, 'user_id': {{$parents->id}}},
           beforeSend : function()
           {
            //$("#preview").fadeOut();
            //$("#err").fadeOut();
           },
           success: function(data)
           {
                    
                if(data.errors)
                {
                    
                    swal("Failed", "All fields are required, Please fill the detail before submitting.", "error");
                }
                else
                {
                    $("#txtphone").val("");
                    $('#TblProjectLinksPhone tr:last').after(data.messages);
                    swal("Success", "Added successfully.", "success");		
                }
            },
                complete: function() {
                    $('#loader').hide();
            }
        });
        
        return false;
        });
        //Add Address book Ends		//PHONE
        
        
        //Delete Address book Begins
        $('button[data-notif-id]').click(function () {
        var LinkID=$(this).data("id")
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
           url: "/addressbook/"+LinkID,
           type: "POST",
           data:  {'_method': 'DELETE', 'id': LinkID },
           beforeSend : function()
           {
            //$("#preview").fadeOut();
            //$("#err").fadeOut();
            
           },
           success: function(data)
           {
                    
                if(data.errors)
                {
                    //$("#errmessage").html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Unable to sent message, please try again.</div>').fadeIn().fadeOut(5000);
                    swal("Failed", data.errors, "error");
                }
                else
                {
                    //$('#TblProjectLinks tr:last').after(data.messages);
                    $('#MyLinks_'+LinkID).remove();
                    swal("Success", data.messages, "success");
                    //$('#IDlinkadding').
                    
                }
            },
                complete: function() {
                    $('#loader').hide();
            }
        });
        return false;
        });
        
        </script>		  
		  
		  
		  
		  
		  
		  
		  
<script>
		
$("#hrstatus").on('change',(function() {
	if($("#hrstatus").val()==5 || $("#hrstatus").val()==7 || $("#hrstatus").val()==8 || $("#hrstatus").val()==9){
		$("#interviewdate").prop("disabled", false); 
		$("interviewdate").attr("required", true);
		//$('#applicationinfo').hide();
	}else{
		//$('#applicationinfo').hide();
		$("#interviewdate").prop("disabled", true); 
		$("interviewdate").attr("required", false);
	}
}));

$("#frmAddHRLeadStatus").on('submit',(function(e) {
	e.preventDefault();	
	$.ajax({
         url: "{{url('/hrleads/status')}}",
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
                  if(data.errors.status){
                    errordetails+=data.errors.status+ "\n";
                  }
                  if(data.errors.remarks){
                    errordetails+=data.errors.remarks+ "\n";
                  }
                  swal("Failed", "Unable to Create.\n " + errordetails , "error");
                }
                else
                {
                  //$('#modal-default').modal('toggle');
                  
                  swal("Success", "Status updated successfully.", "success");
				  var dt = new Date();
				  var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
				  var statusdata ='<tr><td>'+$('#hrstatus option:selected').text() + '</td> <td> ' + $('#remarks').val() + ' </td><td>{{auth()->user()->fname}} {{auth()->user()->lname}}</td>'+ ' </td><td>' + time +'</td></tr>';
				  $('#statustable').append(statusdata);
				  
				  $("#frmAddHRLeadStatus")[0].reset(); 
				  InitTable();
                  $(".loading").fadeOut();
                }
            },
            error: function(e) 
              {
                $(".loading").fadeOut();
                swal("Failed", "Unable to update, Please try again later.", "error");
              }          
       });
}));
 
</script>