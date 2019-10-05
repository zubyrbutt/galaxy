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
              <h3 class="box-title"> Details</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body" >


               @if($message = Session::get('delete'))
                      <div class="alert alert-danger alert-block">
                      <button type="button" class="close" data-dismiss="alert">
                      </button>
                            <strong>{{$message}}</strong>
                        </div>
                    @endif
                     @if($message = Session::get('success'))
                      <div class="alert alert-success alert-block">
                      <button type="button" class="close" data-dismiss="alert">
                      </button>
                            <strong>{{$message}}</strong>
                        </div>
                    @endif

                    <div class="alert alert-danger alert-styled-left" style="display: none;" id="delete">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="delete"></p>
                    </div>

                    <div class="alert alert-success alert-styled-left" style="display: none;" id="success">
                         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="success"></p>
                    </div>
            <div class="row">
              <div class="col-md-8">
              <table class="table table-striped table-bordered responsive nowrap">
                <tr>
                    <td><b>ID</b></td>
                    <td>{{$data['journalVoucher']->id}}</td>
                </tr>
                 <tr>
                    <td><b>Dated</b></td>
                    <td>{{$data['journalVoucher']->dated}}</td>
                </tr>
                <tr>
                    <td><b>Voucher No</b></td>
                    <td>{{$data['journalVoucher']->voucher_no}}</td>
                </tr>
                <tr>
                    <td><b>Type</b></td>
                    <td>{{$data['journalVoucher']->type}}</td>
                </tr>
               

                <tr>
                    <td><b>Description</b></td>
                    <td>{{$data['journalVoucher']->description}}</td>
                </tr>

               

                <tr>
                    <td><b>Posted</b></td>
                    <td>{{$data['journalVoucher']->posted}}</td>
                </tr>
                 
                <tr>
                    <td><b>Created At</b></td>
                    <td>{{$data['journalVoucher']->created_at->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <td><b>Updated At</b></td>
                    <td>{{$data['journalVoucher']->updated_at->format('d-m-Y')}}</td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                    <td>
                        
                          <span class="text-green"><b>{{$data['journalVoucher']->status}}</b></span>
                        
<!--                             <span class="text-red"><b>Deactive</b></span>
 -->                       
                    </td>
                </tr>

              </table>


              </div>
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ URL::previous() }}" class="btn btn-default">Back</a>
                <a href="#" class="btn btn-default pull-right btnPrintModal">Print Modal</a>
              </div>

              <!-- /.box-footer -->

</div>

<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Detail</h3>
              
              <span class="pull-right">
                <!-- <a href="#" class="btn btn-info btnAdd"><span class="fa fa-plus"></span> Add </a> -->
              </span>
              
            </div>
            <!-- /.box-header -->
             <div class="box-body">
            
              <table id="table_data" class="display table-striped table-bordered responsive nowrap table_data" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Account Name</th>
                  <th>Debit</th>
                  <th>Credit</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
               
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
</div>


<!--Modal -->
 {{-- <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Form</h4>
          <div class="alert alert-danger alert-styled-left" style="display: none;" id="error">
                         <button type="button" class="close close_massage"><span>×</span><span class="sr-only">Close</span></button>
                         <p class="error"></p>
            </div>
        </div>
        <div class="modal-body">
          
          <form action="{{route('journalVoucherDetail.add')}}" class="form" id="jv_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                        <h4>Debit Transaction</h4>
                        <div class="form-group">
                            <label>Account</label>
                            <select type="text" name="debit_account_id" id="debit_account_id" class="form-control" required="required">
                              @foreach($data['chartAccount'] as $row)
                              <option value="{{$row->id}}">{{$row->account_name}}</option>
                              @endforeach
                            </select>
                            <span class="text-red">
                              <strong class="debit_account_id"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label>Debit</label>
                           <input type="number"  class="form-control" id="debit" name="debit" required>
                            <span class="text-red">
                              <strong class="debit"></strong>
                            </span>
                        </div> 
                        <h4>Credit Transaction</h4>
                        <div class="form-group">
                            <label>Account</label>
                            <select type="text" name="credit_account_id" id="credit_account_id" class="form-control" required="required">
                              @foreach($data['chartAccount'] as $row)
                              <option value="{{$row->id}}">{{$row->account_name}}</option>
                              @endforeach
                            </select>
                            <span class="text-red">
                              <strong class="credit_account_id"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label>Credit</label>
                           <input type="number"  class="form-control" id="credit" name="credit" required>
                            <span class="text-red">
                              <strong class="credit"></strong>
                            </span>
                        </div> 
                        
                    <input type="hidden" name="edit_id" id="edit_id" value="">     
                    <input type="hidden"  id="journal_voucher_id" name="journal_voucher_id" value="{{$data['journalVoucher']->id}}">    
                </div>
         
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" id="jv-journalVoucherDetail-update" value="Save">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        </div>
      </div>
      </form>
    </div>
  </div>
  --}}
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
            <p  id="voucher"> {{$data['journalVoucher']->voucher_no}}</p>
          </div>
          <div class="pull-left">
            <label>Date</label>
            <p  id="date"> {{$data['journalVoucher']->dated}}</p>
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
                <tbody>
                  @foreach($data['journalVoucher']->journalVoucherDetail as $row)
                   <tr>
                     <td>{{$row->id}}</td>
                     <td>{{$row->account->account_name}}</td>
                     <td>{{$row->debit}}</td>
                     <td>{{$row->credit}}</td>
                   </tr>
                  @endforeach 
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
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>


<script type="text/javascript">
var InitTable = function(){
    $('#table_data').DataTable({
      "bDestroy": true,
      "processing":true,
      "serverSide":true,
      "ajax":{
               "url": "{{ route('journalVoucherDetail.fetch') }}",
               "dataType": "json",
               "type": "POST",
               "data":{ _token: "{{csrf_token()}}",id:"{{$data['journalVoucher']->id}}"}
             },
      "columns": [
                { "data": "id" },
                { "data": "account_id" },
                { "data": "debit" },
                { "data": "credit" },
            ]
    });
  }
 $( document ).ready(function() {

  InitTable();
});

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

$(document).on('click', '.btnPrintModal', function()
{
    $('#voucherPrintViewModel').modal('show');   

});

//  $('#jv-journalVoucherDetail-update').on('click', function(e) {

//   var data = $('#jv_form').serializeArray();
  
//   event.preventDefault();
//   $.ajax({
//           data: data,
//           type: $('#jv_form').attr('method'),
//           url: $('#jv_form').attr('action'),
//           success: function(response)
//           {
            
//             if(response.errors)
//             {
//               $(".account_id").html(response.errors.account_id);
//               $('.account_id').fadeIn('slow', function(){
//                 $('.account_id').delay(3000).fadeOut(); 
//               });
              
//               $(".debit").html(response.errors.attribute_value);
//               $('.debit').fadeIn('slow', function(){
//                 $('.debit').delay(3000).fadeOut(); 
//               });

//                $(".credit").html(response.errors.attribute_value);
//               $('.credit').fadeIn('slow', function(){
//                 $('.credit').delay(3000).fadeOut(); 
//               });
              
//             }else if(response.success){
//               $('.error').html(response.success);
//               $('#error').show();
//             }
//             else
//             {
//               InitTable();
//               $('#myModal').modal('hide');
//               $('.success').html(response);
//               $('#success').show();
//               $('#jv_form')[0].reset();
              

              
             
              
//             }
//           }
//         });
// }); 

</script>

@endsection
