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
<style type="text/css">
 #myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
  }

  #myImg:hover {opacity: 0.7;}

  .modals {
    display: none; 
    position: fixed; 
    z-index: 1; 
    padding-top: 100px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%; 
    overflow: auto;
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.9); 
    } 
  .modal-contents {
    margin: auto;
    display: block;
    width: 80%;
    height: 80%;
    max-width: 700px;
  }

  #caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
  }

  .modal-contents, #caption {  
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
  }

  @-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
  }

  @keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
  }

  .close {
    position: absolute;
    /*top: 15px;*/
    right: 15%;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
  }

  .close:hover,
  .close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
  }

  @media only screen and (max-width: 700px){
    .modal-contents {
      width: 100%;
    }
  }
</style>
<div class="row">
        <div class="col-xs-12">

      <form class="form-horizontal filter_form" id="filter_form" enctype="multipart/form-data">
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
                  <label>Status</label>
                  <select name="status" id="filter_status" class="form-control select2 select2-hidden-accessible" data-placeholder="Option Select" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option value="">Choose Option</option>
                          <option value="Paid">Paid</option>
                          <option value="Not Paid">Not Paid</option>
                          <option value="Return">Return</option>
                          <option value="Stop">Stop</option>
                          <option value="Cancel">Cancel</option>
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
              <h3 class="box-title">All Committed Payable cheque</h3>
              <span class="pull-right">
                <a href="#" class="btn btn-info addModel" id="#addModel"><span class="fa fa-plus"></span> Add</a>
                
              </span>
            </div>
            <!-- /.box-header -->
             <div class="box-body">
            
              <table id="table_data" class="display table-striped table-bordered responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Cheque Date</th>
                  <th>Status</th>
                  <th>Bank Account</th>
                  <th>Amount</th>
                  <th>Party Name</th>
                  <th>Cheque</th>
                  <th>Cheque No</th>
                  <th>Created At</th>
                  <th>Remarks</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Cheque Date</th>
                  <th>Status</th>
                  <th>Bank Account</th>
                  <th>Amount</th>
                  <th>Party Name</th>
                  <th>Cheque</th>
                  <th>Cheque No</th>
                  <th>Created At</th>
                  <th>Remarks</th>
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
<!-- Table end -->


<!--add Modal -->
<div class="modal fade" id="addModel" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Committed Payable cheque Form</h4>
            </div>
              <form class="form-horizontal form" id="add_payment_form" action="{{route('payableCommitted.store')}}" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                        @csrf
                        <div class="box-body" >
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="fname" class="col-sm-4 control-label">Cheque Maturity Date</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" id="maturity_date" name="maturity_date" value="{{ old('maturity_date') }}" require >
                                            <span class="text-red">
                                                 <strong class="maturity_date"></strong>
                                            </span>
                                           
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="col-sm-4 control-label">Bank Account Name</label>
                                        <div class="col-sm-8">
                                            <select type="text" class="form-control select2" id="bank_id" name="bank_id" require tabindex="-1" aria-hidden="true" style="width: 350px">
                                                @foreach($data['bank'] as $row)
                                                    <option value="{{$row->id}}">{{$row->account_title}}-{{$row->account_number}} ({{$row->bank_name}})</option>
                                                @endforeach
                                            </select>
                                            <span class="text-red">
                                                <strong class="bank_id"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cheque_no" class="col-sm-4 control-label">Cheque No</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="cheque_no" name="cheque_no" placeholder="Cheque No" autocomplete="off" value="{{ old('cheque_no') }}" require >
                                            <span class="text-red">
                                                <strong class="cheque_no"></strong>
                                             </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="scanned_cheque" class="col-sm-4 control-label">Scanned Cheque</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" id="scanned_cheque" name="scanned_cheque"  autocomplete="off" value="{{ old('scanned_cheque') }}"  >
                                            <span class="text-red">
                                              <strong class="scanned_cheque"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount" class="col-sm-4 control-label">Amount</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" autocomplete="off" value="{{ old('amount') }}" require >
                                            <span class="text-red">
                                               <strong class="amount"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="status" class="col-sm-4 control-label">Party Name</label>
                                        <div class="col-sm-8">
                                          <select type="text" class="form-control select2" id="party_name" name="party_name" require tabindex="-1" aria-hidden="true" style="width: 350px">
                                                @foreach($data['chartAccount'] as $row)
                                                    <option value="{{$row->id}}">{{$row->account_name}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-red">
                                                <strong class="party_name"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="remarks" class="col-sm-4 control-label">Remarks</label>
                                        <div class="col-sm-8">
                                            <textarea type="text" class="form-control" id="remarks" name="remarks" placeholder="Remarks" autocomplete="off" value="{{ old('remarks') }}" require ></textarea>
                                            <span class="text-red">
                                              <strong class="remarks"></strong>
                                            </span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="edit_id" id="edit_id" value="">
                                </div>
                            </div>
                        </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-primary" id="add_btn_payment" value="Save">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
          </form>  
        </div>
    </div>
</div>
<!--add  Modal end-->

<!--Add consume amount Modal -->
  <div class="modal fade" id="statusmyModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change status</h4>
        </div>
        <div class="modal-body">
           
           <form class="form-horizontal form" action="{{route('payableCommitted.status.store')}}" method="post" id="status_form" enctype="multipart/form-data">
            @csrf
            <div class="box-body" >
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="fname" class="col-sm-3 control-label">Cheque Maturity Date</label>
                  <div class="col-sm-9">
                    <input type="date" class="form-control" id="maturity_date_status" readonly="readonly" name="maturity_date" value="{{ old('maturity_date') }}" require >
                    <span class="text-red">
                              <strong class="maturity_date"></strong>
                    </span>
                    @if ($errors->has('maturity_date'))
                          <span class="text-red">
                              <strong>{{ $errors->first('maturity_date') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                 <div class="form-group">
                  <label for="status" class="col-sm-3 control-label">Bank Account Name</label>

                  <div class="col-sm-9">
                    <select type="text" class="form-control" id="bank_id_status" readonly="readonly" name="bank_id" require>
                      @foreach($data['bank'] as $row)
                      <option value="{{$row->id}}">{{$row->account_title}}-{{$row->account_number}} ({{$row->bank_name}})</option>
                      @endforeach
                    </select>
                   
                      <span class="text-red">
                              <strong class="bank_id"></strong>
                    </span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="cheque_no" class="col-sm-3 control-label">Cheque No</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="cheque_no_status" readonly="readonly" name="cheque_no" placeholder="Cheque No" autocomplete="off" value="{{ old('cheque_no') }}" require >
                    <span class="text-red">
                              <strong class="cheque_no"></strong>
                    </span>
                  </div>
                </div>
                
                <div class="form-group">
                  <label for="amount" class="col-sm-3 control-label">Amount</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="amount_status" readonly="readonly" name="amount" placeholder="Amount" autocomplete="off" value="{{ old('amount') }}" require >
                    <span class="text-red">
                              <strong class="amount"></strong>
                    </span>
                    @if ($errors->has('amount'))
                          <span class="text-red">
                              <strong>{{ $errors->first('amount') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="party_name" class="col-sm-3 control-label">Party Name</label>
                  <div class="col-sm-9">
                      <select type="text" class="form-control" id="party_name_status" name="party_name" require>
                          @foreach($data['chartAccount'] as $row)
                              <option value="{{$row->id}}">{{$row->account_name}}</option>
                          @endforeach
                      </select>
                      <span class="text-red">
                          <strong class="party_name"></strong>
                      </span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="remarks" class="col-sm-3 control-label">Remarks</label>
                  <div class="col-sm-9">
                    <textarea type="text" class="form-control" id="remarks_status" readonly="readonly" name="remarks" placeholder="Remarks" autocomplete="off" value="{{ old('remarks') }}" require ></textarea>
                    <span class="text-red">
                              <strong class="remarks"></strong>
                    </span>
                    @if ($errors->has('remarks'))
                          <span class="text-red">
                              <strong>{{ $errors->first('remarks') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
               <div class="form-group">
                  <label for="remarks" class="col-sm-3 control-label">Status</label>
                <div class="col-sm-9">
                    <select type="text" class="form-control" id="status_status"  name="status" require>
                     
                      <option value="Paid">Paid</option>
                      <option value="Not Paid">Not Paid</option>
                      <option value="Cancel">Cancel</option>
                      <option value="Return">Return</option>
                      <option value="Stop">Stop</option>
                      
                    </select>
                   
                      <span class="text-red">
                              <strong class="status"></strong>
                    </span>
                </div>
                </div>
              </div>
              </div>
            </div>
                <input type="hidden" name="edit_id" id="edit_id_status" readonly="readonly" value="">
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right" id="status_formbtn">Save</button>
              </div>
              <!-- /.box-footer -->
        </form>
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<!--Add consume amount Modal end-->
 <div id="myModal" class="modals">
      <span class="close">&times;</span>
      <img class="modal-contents" id="img01">
      <div id="caption"></div>
</div>
      <!-- /.row -->  
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
       <!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>
<link href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
  <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
  <script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <link href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<script src="{{ asset('erp/app.js')}}" type="text/javascript"></script>

<script type="text/javascript">
  var modal = document.getElementById('myModal');

  $(document).on('click','#show_img',function(){
  var modalImg = document.getElementById("img01");
  var captionText = document.getElementById("caption");
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
});

  $(document).on('click','.close',function(){
   modal.style.display = "none";
  });

  var dataTableRoute = "{{ route('payableCommitted.fetch') }}";
  var token = '{{csrf_token()}}';
  var data = [
                { "data": "id" },
                { "data": "maturity_date" },
                { "data": "status" },
                { "data": "bank_id" },
                { "data": "amount" },
                { "data": "party_name" },
                 { "data": "scanned_cheque"},
                 { "data": "cheque_no"},
                 { "data": "created_at"},
                { "data": "remarks" },
                { "data": "options" ,"orderable":false},
            ]

$(document).on('click', '.addModel', function()
{
    $('#edit_id').val('');
    $('#addModel').modal('show');
    $('#add_payment_form')[0].reset();

});

$( document ).ready(function() {

  InitTable();



$( document ).on('click','#add_btn_payment', function(e) {
e.preventDefault();
var formData = new FormData();
var file = $('#scanned_cheque').get(0).files[0];
if (file) {
formData.append('scanned_cheque', file);
}
formData.append('_token', '{{csrf_token()}}');
formData.append('maturity_date', $('#maturity_date').val());
formData.append('bank_id', $('#bank_id').val());
formData.append('cheque_no', $('#cheque_no').val());
formData.append('amount', $('#amount').val());
formData.append('party_name', $('#party_name').val());
formData.append('remarks', $('#remarks').val());
formData.append('edit_id', $('#edit_id').val());


  $.ajax({
          data: formData,
          type: $('#add_payment_form').attr('method'),
          url: $('#add_payment_form').attr('action'),
          contentType: false,
          processData: false,
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
              $('#add_payment_form')[0].reset();
              $('#addModel').modal('hide');
            }
          
          }
        });
});



$(document).on('click', '.payment_edit', function()
{

var id = $(this).attr('data-id');
$.ajax({
        "url": "{{route('payableCommitted.edit')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        success: function(data)
        {
          $('#edit_id').val(data.id);
          $('#bank_id').val(data.bank_id);
          $('#cheque_no').val(data.cheque_no);
          $('#amount').val(data.amount);
          $('#party_name').val(data.party_name);
          $('#maturity_date').val(data.maturity_date);
          //$('#scanned_cheque').val(data.scanned_cheque);
          $('#remarks').val(data.remarks);
                                
          $('#addModel').modal('show');
        },
          error: function(){},          
      });
});

$(document).on('click', '.status', function()
{

var id = $(this).attr('data-id');
$.ajax({
        "url": "{{route('payableCommitted.status')}}",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        success: function(data)
        {
          console.log(data.bank_id);
          $('#edit_id_status').val(data.id);
          $('#bank_id_status').val(data.bank_id);
          $('#cheque_no_status').val(data.cheque_no);
          $('#amount_status').val(data.amount);
          $('#party_name_status').val(data.party_name);
          $('#maturity_date_status').val(data.maturity_date);
          $('#remarks_status').val(data.remarks);
          $('#status_status').val(data.status);
                                
          $('#statusmyModal').modal('show');
        },
          error: function(){},          
      });
});


$('#status_formbtn').on('click', function(e) {
  //alert($(this).attr('action'));
  var data = $('#status_form').serializeArray();
  console.log(data);
  event.preventDefault();

  $.ajax({
          data: data,
          type: $('#status_form').attr('method'),
          url: $('#status_form').attr('action'),
          success: function(response)
          {

            console.log(response);
           
           //alert('dsfsdf')
              InitTable();
              $('.success').html(response);
              $('#success').show();
              $('#status_form')[0].reset();
              $('#statusmyModal').modal('hide');
             
              
          
          }
        });
});


$(document).on('click', '.delete-category', function()
{
//alert('asdasd');
   $('.tab-pane').removeClass('active');
  $('#colored-rounded-tab1').addClass('active');
var id = $(this).attr('data-id');
$.ajax({
        "url": "",
        type: "POST",
        data: {'id': id,_token: '{{csrf_token()}}'},
        dataType : "json",
        success: function(data)
        {
              InitTable();
              $('.delete').html(data);
              $('#delete').show();
              var succ = $('.delete');
              scrollTo(succ,-100);
        },
          error: function(){},          
      });
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
       var status       =    $('#filter_status').val();
       var dateFrom     =    $('#dateFrom').val();
       var dateTo       =    $('#dateTo').val();
    event.preventDefault();  
   $.ajax({
            url: "{{url('getFilterData')}}",
            type: "POST",
            data: {_token:'{{csrf_token()}}','status':status,'dateFrom':dateFrom,'dateTo':dateTo},
            dataType : "json",
            success: function(data){
              InitTable();
    },
    error: function(){},          
    });
});

$('.clearfix').on('click', '#filterClear', function (event) { 
   event.preventDefault();
       $('.filter_form')[0].reset();
       var status       =    $('#filter_status').val('');
       var dateFrom     =    $('#dateFrom').val('');
       var dateTo       =    $('#dateTo').val(''); 
  InitTable();
});   
</script>
@endsection