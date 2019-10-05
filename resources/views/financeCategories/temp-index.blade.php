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
  
    $cat_sub = \App\AccountChart::where('parent_id',$p_id)->orderby('account_name','ASC')->get();
    foreach ($cat_sub as $key) {
    
    echo '<option value="'.$key->id.'">'.$sub.$key->account_name.'</option>';
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
<!--             <div id="table_data"></div>
 -->   
              <div id="treecontainer">
                <!-- <ul>
                  <li>Root node
                    <ul>
                      <li>Child node 1</li>
                      <li>Child node 2

                               <ul>
                      <li>Child node 1</li>
                      <li>Child node 2</li>
                    </ul>
                      </li>
                    </ul>
                  </li>
                </ul> -->
              </div>   

              <!-- <table id="table_data" class="display table-striped table-bordered responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Category Name</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </tfoot>
              </table> -->
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- Table end -->

<!--Modal -->
  <div class="modal fade" id="addModel" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Form</h4>
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
                        <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Is Transactionable</button>
                        <input type="checkbox" class="hidden"  name="is_transactionable" value="1">
                        </span>

                        <span class="button-checkbox">
                        <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Is Default</button>
                        <input type="checkbox" class="hidden"  name="is_default" value="1">
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
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.7/themes/default/style.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.7/jstree.min.js"></script>


<script type="text/javascript">
//  var InitTable = function() {
        
//            $.ajax({
//              "url": "{{ route('chartOfAccount.fetch') }}",
//              "dataType": "json",
//              "type": "POST",
//              "data":{ _token: "{{csrf_token()}}"},

//              "complete": function(xhr, responseText){
//                  //myJSON = JSON.stringify(xhr);
//                     console.log(xhr);
                    
//                     $('#table_data').html(xhr.responseText);

                    
//                 },
//               });
    
// }


$( document ).ready(function() {
$('#treecontainer').jstree({
    'core' : {
       "check_callback" : function (operation, node, parent, position, more) {
      if(operation === "copy_node" || operation === "move_node") {
        console.log(position);
        if(parent.id === "#") {
          return false; // prevent moving a child above or below the root
        }

      }
      console.log(node);
      return true; // allow everything else
    },
      'data' : {
        "url" : "{{ route('chartOfAccount.fetch') }}",
        "dataType": "json",
        success: function(response)
        {
          

          console.log(response);
        }
      }

    },
    "plugins" : ["dnd","contextmenu"]
  });
  //InitTable();
// code for add form modal show
$(document).on('click', '.addModelbtn', function()
{
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
    //InitTable();
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



<script>




</script>

<!-- 'core' : {
      'data' : [
          {
              "text" : "Root node",
              "state" : {"opened" : true },
              "children" : [
                  {
                    "text" : "Child node 1",
                    "state" : { "selected" : true },
                    "icon" : "glyphicon glyphicon-plus"
                  },
                  { "text" : "Child node 2", "state" : { "disabled" : true } }
              ]
        }
      ]
    } -->
@endsection