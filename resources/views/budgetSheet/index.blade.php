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






<!-- Form start -->
<div class="row">
        <div class="col-xs-12">

           <form class="form-horizontal filter_form" enctype="multipart/form-data">
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
          <div class="box-body" style="display: block;">
              <div class="row">
                <div class="col-md-6">
                  <label>Select Month</label>
                  <select name="budget_month" id="filter_budget_month" class="form-control select2 select2-hidden-accessible" data-placeholder="Option Select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="">Choose Option</option>
                        <?php $budget_month = date("F"); ?>
                          @foreach($keymonths  as $key => $row)
                                <option value="{{$row}}" @if($row ==$budget_month) selected="selected" @endif>{{$row}}</option>
                          @endforeach 
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Select Year</label>
                    <select name="budget_year" id="filter_budget_year" class="form-control    select2  select2-hidden-accessible" data-placeholder="Option Select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="">Choose Option</option>
                              <?php $budget_year =   date("Y"); ?>
                              @for($i=0; $i<8; $i++)
                                <option value="{{$budget_year + $i}}" @if($budget_year + $i ==$budget_year) selected="selected" @endif>{{$budget_year + $i}}</option>
                              @endfor  
                  </select>
                </div>
              </div>
            <!-- Search Form Ends -->
            <div class="row">
              <div class="col-md-12">
              <button style="margin-top: 10px;" type="submit" class="pull-right btn btn-primary" id="filterRecords">Search
                <i class="fa fa-search"></i></button>
                </div>
          </div>
          </div>




          <!-- /.box-body -->
          
        </div>
        <!-- /.box -->
      </form>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- Form end -->

<!-- Table start -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Manage Budget Sheet</h3>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
            
              <table  class="table table-bordered display responsive nowrap" style="width:100%">
                <thead>
                  <th>Department Name</th>
                  <th>Allocated</th>
                  <th>Consumed</th>
                  <th>Remaining</th>
                  <th>Required</th>
                  <th>Deficit</th>
                  <th colspan="2">Action</th>
                </thead>

                <tbody id="table_data">
                  
                </tbody>
                <tfoot id="footer_data">
                  
                </tfoot>
                
              </table>
              <div  class="ajaxBusy" style="width:500px;margin: 0 auto"><img src="<?php echo asset('img/loading.gif'); ?>" style="width:100px;"></div>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- Table end -->
      <!-- /.row --> 

 <!--Add consume amount Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Budget</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('budgetSheet.store')}}" class="form" id="edit_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                        <div class="form-group">
                            <label>Select Main Category</label>
                            <select class="form-control" name="budgetcategory_id" id="budgetcategory_id" required="required">
                              @foreach($budgetCategory  as $row)
                                <option value="{{$row->id}}">{{$row->category_name}}</option>
                              @endforeach   
                              </select>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" name="allocate_amount" id="allocate_amount" class="form-control" value="" required="required">
                        </div>

                       <?php 

                         $value = session()->get('filter');
                         if($value['budget_month']!=""|| $value['budget_year']!=""){
                              
                              $budget_month = $value['budget_month'];
                              $budget_year = $value['budget_year'];

                          }else{

                              $budget_month = date("F");
                              $budget_year =   date("Y");
                          }

                         ?>

                        <div class="form-group">
                            <label>Budget Month</label>
                            <select class="form-control" required="required" name="budget_month" id="budget_month">
                              @foreach($months  as $row)
                                <option value="{{$row}}" @if($budget_month ==$row) selected="selected" @endif>{{$row}}</option>
                              @endforeach   
                              </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Budget Year</label>
                           <!--  <input type="text" readonly="readonly" name="budget_year" id="budget_year" class="form-control" value="" > -->
                        
                      
                          <select name="budget_year" required="required" id="budget_year" class="form-control    select2  select2-hidden-accessible" data-placeholder="Option Select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="">Choose Option</option>
                              
                              @for($i=0; $i<8; $i++)
                                <option value="{{$budget_year + $i}}" @if($budget_year + $i ==$budget_year) selected="selected" @endif>{{$budget_year + $i}}</option>
                              @endfor  
                  </select>
                  </div>


                        
                </div>
                    <div class="modal-footer">
                      <input type="hidden"  id="budgetcategory" name="budgetcategory" value="">
                      <input type="submit" class="btn btn-primary" id="consumeBudget-update" value="Save">
                    </div>   
            </form>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!--Add consume amount Modal end-->

 <!--Update consume amount Modal -->
  <div class="modal fade" id="ConsumeBudgetAmountModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Amount</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('ConsumeBudgetAmount.store')}}" class="form" id="consumeBudgetDetail_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control" value="" required="required">
                        </div>
                       
                        <div class="form-group">
                            <label>Remarks</label>
                            <input type="text" name="remarks" id="remarks" class="form-control" value="" required="required">
                        </div> 
                        
                        
                </div>
                    <div class="modal-footer">
                      <input type="hidden"  id="ConsumeBudget_id" name="consume_budget_id" value="">
                      <input type="submit" class="btn btn-primary" id="consumeBudgetDetail-update" value="Save">
                    </div>   
            </form>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!--Update consume amount Modal end-->


<div class="modal fade" id="budgetConsumedModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="comsumedBudgetTableHeading"></h4>
        </div>
        <div class="modal-body">
          
          
        <table class="table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Amount</th>
              <th>Created By</th>
              <th>Description</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="comsumedBudgetTable">
            
          </tbody>
        </table>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<style type="text/css">
  .ajaxBusy {
  display: none;
}
</style>

<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript">
  var InitTable = function() {

           $.ajax({
             "url": "{{ route('budgetSheet.fetch') }}",
             "dataType": "json",
             "type": "POST",
             "data":{ _token: "{{csrf_token()}}"},
              beforeSend:function(){
                    // show image here
                    $(".ajaxBusy").show();
                },

             "complete": function(xhr, responseText){
                 //myJSON = JSON.stringify(xhr);
                   // console.log(xhr);
                   // console.log(xhr.responseText);
                    $('#table_data').html(xhr.responseText);
                    $(".ajaxBusy").hide();
                    //$('#footer_data').html(xhr.responseText.dataHtml);
                  
                    
                },
              });
       

      
}

$( document ).ready(function() {

  InitTable();

$('#consumeBudget-update').on('click', function(e) {
  var data = $('#edit_form').serializeArray();
  console.log(data);
  event.preventDefault();
  $.ajax({
          data: data,
          type: $('#edit_form').attr('method'),
          url: $('#edit_form').attr('action'),
          success: function(response)
          {
            if(response.errors)
            {
              $(".budgetcategory_id").html(response.errors.budgetcategory_id);
              $(".allocate_amount").html(response.errors.allocate_amount);
              $(".budget_month").html(response.errors.budget_month);
              $(".budget_year").html(response.errors.budget_year);
              
            }
            else
            {
              InitTable();
              $('.success').html(response);
              $('#success').show();
              $('#edit_form')[0].reset();
              $('#myModal').modal('hide');
             
              
            }
          }
        });
});

$('#consumeBudgetDetail-update').on('click', function(e) {
  //alert($(this).attr('action'));
  var data = $('#consumeBudgetDetail_form').serializeArray();
  console.log(data);
  event.preventDefault();

  $.ajax({
          data: data,
          type: $('#consumeBudgetDetail_form').attr('method'),
          url: $('#consumeBudgetDetail_form').attr('action'),
          success: function(response)
          {

           // console.log(response);
            if(response.errors)
            {
              $(".ConsumeBudget_id").html(response.errors.consume_budget_id);
              $(".amount").html(response.errors.amount);
              $(".remarks").html(response.errors.remarks);
              
            }
            else
            {
           
              InitTable();
              $('.success').html(response);
              $('#success').show();
              $('#consumeBudgetDetail_form')[0].reset();
              $('#ConsumeBudgetAmountModal').modal('hide');
             
              
            }
          }
        });
});

$(document).on('click', '.edit', function()
{

var id = $(this).attr('data-id');
$.ajax({
        "url": "{{route('budgetSheet.edit')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        success: function(data)
        {
          $('#budgetcategory').val(data.id);
          $('#budgetcategory_id').val(data.id);
          //$('#parent_id').val(data.parent_id);
          $('#myModal').modal('show');
        },
          error: function(){},          
      });
});



$(document).on('click', '.editConsumeBudget', function()
{
       event.preventDefault();
    var id = $(this).attr('data-id');
             $('#ConsumeBudget_id').val(id);
             $('#ConsumeBudgetAmountModal').modal('show');

});


$(document).on('click', '.budgetConsumedShow', function()
{

var id = $(this).attr('data-id');
var name = $(this).attr('data-name');
//alert(name);
$.ajax({
        "url": "{{route('budgetSheet.show')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        success: function(data)
        {
         // console.log(data);
          $('#budgetConsumedModal').modal('show');
          $('#comsumedBudgetTable').html(data);
          $('#comsumedBudgetTableHeading').html(name);
         
        },
        error: function(){},          
      });
});

 $('#filterRecords').on('click', function () {
       var budget_month       =    $('#filter_budget_month').val();
       var budget_year     =    $('#filter_budget_year').val();
       //alert(budget_year);
    event.preventDefault();  
   $.ajax({
            url: "{{url('getFilterData')}}",
            type: "POST",
            data: {_token:'{{csrf_token()}}','budget_month':budget_month,'budget_year':budget_year},
            dataType : "json",
            success: function(data){
             // console.log(data.budget_month);
              //console.log(data.budget_year);
              $('#filter_budget_month').val(data.budget_month);
              $('#filter_budget_year').val(data.budget_year);
              $('#budget_month').val(data.budget_month);
              $('#budget_year').val(data.budget_year);
              InitTable();
    },
    error: function(){},          
    });
});

});
</script>
@endsection