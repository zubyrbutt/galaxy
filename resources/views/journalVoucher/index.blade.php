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
          <div class="box-body" style="display: none;">
            <div class="row col-md-12">
               <div class="form-group col-md-6">
                  <label>Select Date Range:</label>
                  <div class="input-group">
                    <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                      <span>MM-DD-YYY - MM-DD-YYY</span>
                      <input type="hidden" name="dateFrom" id="dateFrom" value="">
                      <input type="hidden" name="dateTo" id="dateTo" value="">
                      <i class="fa fa-caret-down"></i>
                    </button>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label>Type</label>
                  <select name="type" id="filter_type" class="form-control select2 select2-hidden-accessible" data-placeholder="Option Select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="">Choose Option</option>
                          <option value="JV">JV</option>
                          <option value="CPV">CPV</option>
                          <option value="CPV">CPV</option>
                          <option value="CRV">CRV</option>
                          <option value="BPV">BPV</option>
                          <option value="BRV">BRV</option>
                  </select>
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
              <h3 class="box-title"> Journal Voucher </h3>
              <span class="pull-right">
                <a href="#" class="btn btn-info addPrintModel" id="#addPrintModel"><span class="fa fa-plus"></span> Add Journal Voucher</a>
                
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
              <table id="table_data" class="table table-striped table-bordered display" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Dated</th>
                  <th>Voucher No</th>
                  <th>Debit</th>
                  <th>Credit</th>
                  <th>Type</th>
                  <th>Description</th>
                  <th>File</th>
                  <th>Created By</th>
                  <th>Created At</th>
                  <th style="width: 140px;">Action</th>
                </tr>
                </thead>
            
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>
<!-- Table end -->

<!--add Modal -->
  <div class="modal fade" id="addPrintModel" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Journal Voucher Form</h4>
            <div class="alert alert-danger alert-styled-left" style="display: none;" id="error">
                         <button type="button" class="close close_massage"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="error"></p>
            </div>
        </div>
        <div class="modal-body">
          
          <form action="{{route('journalVoucher.store')}}" class="form" id="add_print_form" method="POST" role="form" enctype="multipart/form-data">
               @csrf   
                <div class="modal-body" id="modalbody">
                        <div class="form-group">
                                <label>Dated</label>
                                  <input type="date" class="form-control"  name="dated" placeholder="dated" autocomplete="off" value="{{ old('dated') }}" required >
                                  <span class="text-red">
                                            <strong class="edit_dated"></strong>
                                  </span>
                        </div>
                 
                        <div class="form-group">
                          <label>Description</label>
                            <textarea type="text" class="form-control" name="description" autocomplete="off" required></textarea>
                            <span class="text-red">
                                      <strong class="edit_description"></strong>
                            </span>
                        </div>
                        <!--- account dr/cr -->
                        <div class="form-group">
                          <label>Debit Transaction</label>
                            <div ng-app="app" ng-controller="MyCtrl">
                             <table  class="table table-striped table-bordered">
                               <thead>
                                  
                                  <tr>
                                      <th>Account</th>
                                      <th>Debit</th>
                                      <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                 <tr ng-repeat="name in data.names track by $index">
                                     <td> <select  ng-model="data.names1[$index].name" name="debit_account_id[]" required="required"  style="width:100%;">
                                      <option value="">Options</option>
                                      @foreach($data['chartAccount'] as $row)
                                      <option value="{{$row->id}}">{{$row->account_name}}</option>
                                      @endforeach
                                     </select></td>
                                    
                                    <td> <input class="debit<% $index %>" type="number" ng-model="data.names2[$index].name" name="debit[]" required="required" style="width:100%;"></td>

                                    <td> <a ng-click="addRow($index)"  ng-show="$last"><i class="fa fa-plus"></i></a>
                                        <a ng-click="deleteRow($event,name)"  ng-show="$index != 0"><i class="fa fa-close"></i></a>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>   
                        </div>  
                        <!--- account dr/cr -->

                         <!--- account dr/cr -->
                        <div class="form-group">
                          <label>Credit Transaction</label>
                            <div ng-app="app" ng-controller="MyCtrl">
                             <table  class="table table-striped table-bordered">
                               <thead>
                                  
                                  <tr>
                                      <th>Account</th>
                                      <th>Credit</th>
                                      <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                 <tr ng-repeat="name in data.names track by $index">
                                     <td> <select  ng-model="data.names3[$index].name" name="credit_account_id[]" required="required"  style="width:100%;">
                                      <option value="">Options</option>
                                      @foreach($data['chartAccount'] as $row)
                                      <option value="{{$row->id}}">{{$row->account_name}}</option>
                                      @endforeach
                                     </select></td>
                                    
                                    <td> <input class="credit<% $index %>" type="number" ng-model="data.names4[$index].name" name="credit[]" required="required" style="width:100%;"></td>

                                    <td> <a ng-click="addRow($index)"  ng-show="$last"><i class="fa fa-plus"></i></a>
                                        <a ng-click="deleteRow($event,name)"  ng-show="$index != 0"><i class="fa fa-close"></i></a>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>   
                        </div>  
                        <!--- account dr/cr -->
                <div class="form-group">
                  <label>File Upload</label>
                    <input type="file" class="form-control" id="file_upload" name="file_upload" placeholder="File Upload" autocomplete="off" value="{{ old('file_upload') }}" require >
                    <span class="text-red">
                              <strong class="file_upload"></strong>
                    </span>
                </div>
                      
<!--                         <input type="hidden" name="edit_id" id="edit_id" value="">
 -->                        
                </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" id="add_form_print_btn" value="Save">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
<!--add Modal end-->

<!--Modal -->
  <div class="modal fade" id="edit_diff_model" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Journal Voucher Form</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('journalVoucher.update')}}" class="form" id="edit_diff_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                        <div class="form-group">
                                <label>Dated</label>
                                  <input type="date" class="form-control" id="edit_dated"  name="dated" placeholder="dated" autocomplete="off" value="{{ old('dated') }}" required >
                                  <span class="text-red">
                                            <strong class="edit_dated"></strong>
                                  </span>
                        </div>
                 
                        <div class="form-group">
                          <label>Description</label>
                            <textarea type="text" class="form-control" id="edit_description" name="description" autocomplete="off" required></textarea>
                            <span class="text-red">
                                      <strong class="edit_description"></strong>
                            </span>
                        </div>
                       
                        
                      <input type="hidden" name="edit_id" id="edit_id" value="">
                       
                </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" id="edit_diff_btn" value="Save">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
<!--Update Modal end-->

<!-- Journal Voucher Print View--->
<div id="printThis">
  <div class="modal fade" id="voucherPrintViewModel" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button id="btnPrint" type="button" class="btn btn-default pull-right">Print</button>
          
          <div class="pull-right" style="margin-right: 20px;">
            <label>Voucher No</label>
            <p  id="voucher"></p>
          </div>
          <div class="pull-left">
            <label>Dated</label>
            <p  id="date"></p>
          </div>
          
        </div>
        <div class="modal-body">
                <table id="print_table_data" class="table table-striped table-bordered responsive" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Account</th>
                  <th>Debit</th>
                  <th>Credit</th>
                </tr>
                
                </thead>
                <tbody id="tdRow">

                </tbody>
               
              </table>
    </div>
  </div>
</div>  
<!-- Journal Voucher Print View end--->
<style type="text/css">
 @media screen {
  #printSection {
      display: none;
  }
}

@media print {
  body * {
    visibility:hidden;
  }
  #printSection, #printSection * {
    visibility:visible;
  }
  #printSection {
    position:absolute;
    left:0;
    top:0;
  }
}

</style>
      <!-- /.row --> 
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <link href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<script src="{{ asset('erp/app.js')}}" type="text/javascript"></script>
<script type="text/javascript">

var app = angular.module("nomanAngular",[],function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

app.controller("MyCtrl" , function($scope){
  
   $scope.data ={
       names:[{ name:""}]
   };
  
  $scope.addRow = function(index){
    var name = {name:""};
       if($scope.data.names.length <= index+1){
            $scope.data.names.splice(index+1,0,name);
        }
    };
  
  $scope.deleteRow = function($event,name){
  var index = $scope.data.names.indexOf(name);
    if($event.which == 1)
       $scope.data.names.splice(index,1);
    }
  
  });

var dataTableRoute = "{{ route('journalVoucher.fetch') }}";
var editRoute = "{{route('journalVoucher.edit')}}";
var activeRoute = "{{route('journalVoucher.active')}}";
var disableRoute = "{{route('journalVoucher.disable')}}";
var token = '{{csrf_token()}}';
var data =[
            { "data": "id" },
            { "data": "dated" },
            { "data": "voucher_no" },
            { "data": "debit" },
            { "data": "credit" },
            { "data": "type" },
            { "data": "description" },
            { "data": "file_upload" },
            { "data": "created_by" },
            { "data": "created_at" },
            
            { "data": "options" ,"orderable":false},
          ]
$( document ).ready(function() {
  InitTable();
});

// code for add form modal show
$(document).on('click', '.addPrintModel', function()
{
    $('#addPrintModel').modal('show');
    $('#add_print_form')[0].reset();

});

$('#add_form_print_btn').click(function(event) {
     
     InsertData('#add_print_form','#addPrintModel');
     event.preventDefault();

});

$('#edit_diff_btn').click(function() {
     

     EditDifferentModel('#edit_diff_form','#edit_diff_model');

});

// code for edit different model form
function InsertData(editDiffFormId, editDiffFormModel){
 
var data = $(editDiffFormId).serializeArray();

console.log(data);
//event.preventDefault();
$.ajax({
data: data,
type: $(editDiffFormId).attr('method'),
url: $(editDiffFormId).attr('action'),
success: function(response)
{
  console.log(response.dated);
  if(response.errors)
  {
     $.each(response.errors, function( index, value ) {
      $(".edit_"+index).html(value);
      $(".edit_"+index).fadeIn('slow', function(){
        $(".edit_"+index).delay(3000).fadeOut(); 
      });
    });

  }
  else if(response.success){
    $('.error').html(response.success);
    $('#error').show();
  }
  else
  {
    InitTable();

    $(editDiffFormId)[0].reset();
    $(editDiffFormModel).modal('hide');
    $('#voucherPrintViewModel').modal('show');
    console.log(response);
    var html ='';
        
    $.each(response.detail, function( index, value ) {
     console.log(index.id+'|'+value);
           html +='<tr>';
          html +='<td>'+value.id+'</td>';
          html +='<td>'+value.account_name+'</td>';
          html +='<td>'+value.debit+'</td>';
          html +='<td>'+value.credit+'</td>';
          html +='</tr>';
    });
        
    $("#tdRow").html(html);
    $("#voucher").html(response.voucher_no);
    $("#date").html(response.dated);
  }
}
});
}

document.getElementById("btnPrint").onclick = function () {
    printElement(document.getElementById("printThis"));
}

function printElement(elem) {
    var domClone = elem.cloneNode(true);
    
    var $printSection = document.getElementById("printSection");
    
    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }
    
    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
}

$('.close_massage').click(function()
{
     $('.alert').hide();
});

// code for edit form
$('#edit_form_btn').on('click', function(e) {
var data = $('#edit_form').serializeArray();
event.preventDefault();
  $.ajax({
  data: data,
  type: $('#edit_form').attr('method'),
  url: $('#edit_form').attr('action'),
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
    $('#edit_form')[0].reset();
    $('#addModel').modal('hide');
  }
  }
  });
});


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

   $('.clearfix').on('click', '#filterRecords', function () {
       var type       =    $('#filter_type').val();
       var dateFrom     =    $('#dateFrom').val();
       var dateTo       =    $('#dateTo').val();
    event.preventDefault();  
   $.ajax({
            url: "{{url('getFilterData')}}",
            type: "POST",
            data: {_token:'{{csrf_token()}}','type':type,'dateFrom':dateFrom,'dateTo':dateTo},
            dataType : "json",
            success: function(data){
              InitTable();
    },
    error: function(){},          
    });
});

$('.clearfix').on('click', '#filterClear', function () { 
   event.preventDefault();
       $('.filter_form')[0].reset();
       var type       =    $('#filter_type').val('');
       var dateFrom     =    $('#dateFrom').val('');
       var dateTo       =    $('#dateTo').val(''); 
  InitTable();
}); 
</script>
@endsection