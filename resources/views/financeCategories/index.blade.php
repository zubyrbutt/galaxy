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

<?php 

  

function categoryTree($p_id='0',$sub=''){
  
    $cat_sub = \App\AccountChart::where('parent_id',$p_id)->where('status','Active')->orderby('account_name','ASC')->get();
    foreach ($cat_sub as $key) {
    
    echo '<option value="'.$key->id.'" id="select_'.$key->id.'">'.$sub.$key->account_name.'</option>';
    categoryTree($key->id,$sub.'---');
    }
}
  

  ?>




<!-- Table start -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Chart Of Accounts</h3>
              <span class="pull-right">
                <a href="#" class="btn btn-info addModelbtn" id="#addModel"><span class="fa fa-plus"></span> Add</a>
                
              </span>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
              
                    <div class="alert alert-danger alert-styled-left" style="display: none;" id="delete">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="delete"></p>
                    </div>

                    <div class="alert alert-success alert-styled-left" style="display: none;" id="success">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="success"></p>
                    </div>       
    
            <div  id="treeview">          
                    
            </div> 
             
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- Table end -->


<!--Update Modal end--><!--Modal -->
  <div class="modal fade" id="addModel" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Chart Of Account Form</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('chartOfAccount.store')}}" class="form" id="add_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                  <div class="form-group">
                    <label>Name Of Account</label>
                      <input type="text" class="form-control" id="edit_account_name" name="account_name" placeholder="Name Of Account" autocomplete="off" value="{{ old('account_name') }}" require >
                      <span class="text-red">
                                <strong class="account_name"></strong>
                      </span>
                  </div>

                  <div class="form-group">
                    <label>Parent</label>
                        <select type="text" class="form-control" id="parent_id" name="parent_id" require>
                          <?php categoryTree(); ?>
                        </select>
                        <span class="text-red">
                          <strong class="parent_id"></strong>
                      </span>
                  </div>

                  <div class="form-group">
                      <label>Default Type</label>
                      <select type="text" name="default_type" id="edit_default_type" class="form-control" required="required">
                        <option value="Debit">Debit</option>
                        <option value="Credit">Credit</option>
                      </select>
                      <span class="text-red">
                        <strong class="default_type"></strong>
                      </span>
                  </div>
                  <div class="form-group">
                         <span class="button-checkbox">
                        <button type="button" class="btn btn-default" data-color="primary" id="btn_is_transactionable"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Is Transactionable</button>
                        <input type="checkbox" class="hidden" name="is_transactionable" id="edit_is_transactionable"  value="1" >
                        </span>
                   </div>
                  <div class="form-group">
                    <label>Opening Balance</label>
                      <input type="text" class="form-control" id="edit_opening_balance" name="opening_balance" placeholder="Opening Balance" autocomplete="off" value="{{ old('opening_balance') }}" require >
                      <span class="text-red">
                                <strong class="opening_balance"></strong>
                      </span>
                  </div>
                  <div class="form-group">
                    <label>Balance</label>
                      <input type="text" class="form-control" id="edit_balance" name="balance" placeholder="Balance" autocomplete="off" value="{{ old('balance') }}" require >
                      <span class="text-red">
                                <strong class="balance"></strong>
                      </span>
                  </div>



                       
                        <div class="form-group">
                            <label>Status</label>
                            <select type="text" name="status" id="edit_status" class="form-control" required="required">
                              <option value="Active">Active</option>
                              <option value="Disable">Disable</option>
                            </select>
                            <span class="text-red">
                              <strong class="status"></strong>
                            </span>
                        </div> 
                        <input type="hidden" name="edit_id" id="edit_id" value="">
                        
                </div>
              
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" id="add_btn" value="Save">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  

<!--Update Modal end-->
      <!-- /.row -->  
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />
 
  
  


<script type="text/javascript">
var InitTable = function() {
        
$.ajax({ 
   'url': "{{ route('chartOfAccount.fetch') }}",
   'method':"POST",
   'dataType': "json", 
   "data":{ _token: "{{csrf_token()}}"},      
   success: function(data)  
   {
    var dataArray = [];
    for (var key in data) {
          if (data.hasOwnProperty(key)) {
                  dataArray.push(data[key]);
          }
    };
    //console.log(dataArray);
  $('#treeview').treeview({levels: 1,
          data: dataArray});
   }   
 });
          
    
}



$(document).on('click', '.edit_model', function()
{
  
$('#select_parent').removeAttr('selected');
var id = $(this).attr('data-id');
$.ajax({
  "url": "{{ route('chartOfAccount.edit') }}",
  type: "POST",
  data: {'id': id,_token: "{{csrf_token()}}"},
  dataType : "json",
  success: function(data)
  {
    $.each(data, function( index, value ) {
    $('#edit_'+index).val(value);
    });
    if(data.parent_id==0){
      console.log(data.parent_id);
      $('#select_parent').attr('selected',true);
    }else{
      
      $('#select_'+data.parent_id).attr('selected',true);
    }
    
    if(data.is_transactionable==1){

      $("#edit_is_transactionable").prop("checked", true);
      $("#btn_is_transactionable").addClass("active btn-primary");
      $("#btn_is_transactionable").removeClass("btn-default");
      $(".state-icon").addClass("glyphicon-check");
      $(".state-icon").removeClass("glyphicon-unchecked");
     

      
    }else{
      $("#edit_is_transactionable").prop("checked", false);
      $("#btn_is_transactionable").removeClass("active btn-primary");
      $("#btn_is_transactionable").addClass("btn-default");
      $("#edit_is_transactionable").val("1");
      $(".state-icon").removeClass("glyphicon-check");
      $(".state-icon").addClass("glyphicon-unchecked");
    }
    //select_

    $('#addModel').modal('show');
  },
    error: function(){alert('error');},          
});

});

$(document).on('click', '.delete', function()
{
  //event.preventDefault();
var id = $(this).attr('data-id');
$.ajax({
  "url": "{{ route('chartOfAccount.delete') }}",
  type: "POST",
  data: {'id': id,_token: "{{csrf_token()}}"},
  dataType : "json",
  success: function(data)
  {
    
   InitTable();
  },
    error: function(){alert('error');},          
});

});


$( document ).ready(function() {

  InitTable();
// code for add form modal show
$(document).on('click', '.addModelbtn', function()
{
  //alert('hello');
  $("#edit_is_transactionable").prop("checked", false);
  $("#btn_is_transactionable").removeClass("active btn-primary");
  $("#btn_is_transactionable").addClass("btn-default");
  $('#parent_id').val($('#select_1').val());

    $('#addModel').modal('show');
    $('#add_form')[0].reset();

});
// code for add with different model form
$(document).on('click', '#add_btn', function(event)
{
var data = $('#add_form').serializeArray();
event.preventDefault();
$.ajax({
data: data,
type: $('#add_form').attr('method'),
url: $('#add_form').attr('action'),
success: function(response)
{
  if(response.errors)
  {
     $.each(response.errors, function( index, value ) {
      $("."+index).html(value);
      $("."+index).fadeIn('slow', function(){
        $("."+index).delay(3000).fadeOut(); 
      });
    });

  }
  else
  {
    InitTable();
    $('.success').html(response);
    $('#success').show();
    $('#add_form')[0].reset();
    $('#addModel').modal('hide');
    
  }
}
});
});

});

$(function () {
    $('.button-checkbox').each(function () {

        // Settings
        var $widget = $(this),
            $button = $widget.find('button'),
            $checkbox = $widget.find('input:checkbox'),
            color = $button.data('color'),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        // Event Handlers
        $button.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $button.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $button.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$button.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $button
                    .removeClass('btn-default')
                    .addClass('btn-' + color + ' active');
            }
            else {
                $button
                    .removeClass('btn-' + color + ' active')
                    .addClass('btn-default');
            }
        }

        // Initialization
        function init() {

            updateDisplay();

            // Inject the icon if applicable
            if ($button.find('.state-icon').length == 0) {
                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
            }
        }
        init();
    });
});
</script> 

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

@endsection