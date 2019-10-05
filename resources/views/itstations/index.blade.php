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



<!-- Table start -->
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Work Stations </h3>
              <span class="pull-right">
                <a href="#" class="btn btn-info addModelbtn" id="#addModel"><span class="fa fa-plus"></span> Add Station</a>
                
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
            
              <table id="table_data" class="display table-striped table-bordered responsive nowrap" style="width:100%">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Station Number</th>
                  <th>Floor</th>
                  <th>Room</th>
                  <th>Description</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
                </thead>
                <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Station Number</th>
                  <th>Floor</th>
                  <th>Room</th>
                  <th>Description</th>
                  <th>Created At</th>
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
<!-- Table end -->

<!--add Modal -->
  <div class="modal fade" id="addModel" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Work Station Form</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('itstation.store')}}" class="form" id="add_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                  <div class="form-group">
                    <label>Station Number</label>
                      <input type="text" class="form-control"  name="station_number" placeholder="Station Number" autocomplete="off" value="{{ old('station_number') }}" require >
                      <span class="text-red">
                                <strong class="station_number"></strong>
                      </span>
                      @if ($errors->has('station_number'))
                            <span class="text-red">
                                <strong>{{ $errors->first('station_number') }}</strong>
                            </span>
                        @endif
                  </div>
                       
                       

                        <div class="form-group">
                            <label>Floor</label>
                            <select type="text" name="floor_id" id="floor_id"  class="form-control" required="required">
                             <option value="">Choose Option</option>
                                @foreach($data['floor'] as $row)
                                <option value="{{$row->id}}">{{$row->floor_no}}</option>
                                @endforeach
                            </select>
                            <span class="text-red">
                              <strong class="floor"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <label>Room No</label>
                            <select type="text" name="room_id" id="room_id" class="form-control" required="required">
                             <option value="">Choose Option</option>
                                
                            </select>
                            <span class="text-red">
                              <strong class="floor"></strong>
                            </span>
                        </div>

                        
                       
                        <!--- Inventory Specification -->
                        <div class="form-group">
                          <label>Inventories</label>
                            <div ng-app="app" ng-controller="MyCtrl">
                             <table  class="table table-striped table-bordered">
                               <thead>
                                  
                                  <tr>
                                      <th>Inventory Name</th>
                                      <th>Inventory SNO's</th>
                                      <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                 <tr ng-repeat="name in data.names track by $index">
                                     
                                    <td>
                                        <select type="text" ng-model="data.names1[$index].name" name="inventory_id[]" id="inventory_sno_id<%$index%>" class="inventory_id" required="required" style="width:100%;">
                                        <option value="">Choose Options</option>
                                        @foreach($data['inventories'] as $row)
                                        <option value="{{$row->id}}">{{$row->title}}</option>
                                        @endforeach
                                      </select>
                                    </td>
                                    
                                    <td>
                                      <select type="text" ng-model="data.names2[$index].name" name="inventory_sno_id[]" class="inventory_sno_id<%$index%>" required="required" style="width:100%;">
                                        
                                      </select>
                                    </td>  

                                   
                                    <td> <a ng-click="addRow($index)"  ng-show="$last"><i class="fa fa-plus"></i></a>
                                        <a ng-click="deleteRow($event,name)"  ng-show="$index != 0"><i class="fa fa-close"></i></a>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>   
                        </div>  
                        <!--- Inventory Specification --> 

                         <div class="form-group">
                          <label>Description</label>
                            <input type="text" class="form-control" name="description" placeholder="Description" id="description" autocomplete="off" value="{{ old('description') }}" require >
                            <span class="text-red">
                                      <strong class="description"></strong>
                            </span>
                            @if ($errors->has('description'))
                                  <span class="text-red">
                                      <strong>{{ $errors->first('description') }}</strong>
                                  </span>
                              @endif
                        </div>   
                        <div class="form-group">
                            <label>Status</label>
                            <select type="text" name="status" id="status"  class="form-control" required="required">
                              <option value="Active">Active</option>
                              <option value="Disable">Disable</option>
                            </select>
                            <span class="text-red">
                              <strong class="status"></strong>
                            </span>
                        </div> 


<!--                         <input type="hidden" name="edit_id" id="edit_id" value="">
 -->                        
                </div>
                      
            



        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" id="add_form_btn" value="Save">
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
          <h4 class="modal-title">Work Station Form</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('itstation.store')}}" class="form" id="edit_diff_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                  <div class="form-group">
                    <label>Station Number</label>
                      <input type="text" class="form-control"  name="station_number" id="edit_station_number" placeholder="Station Number" autocomplete="off" value="{{ old('station_number') }}" require >
                      <span class="text-red">
                                <strong class="edit_station_number"></strong>
                      </span>
                  </div>
                       
                        <div class="form-group">
                            <label>Floor</label>
                            <select type="text" name="floor_id" id="edit_floor_id"  class="form-control" required="required">
                             <option value="">Choose Option</option>
                                @foreach($data['floor'] as $row)
                                <option value="{{$row->id}}">{{$row->floor_no}}</option>
                                @endforeach
                            </select>
                            <span class="text-red">
                              <strong class="edit_floor_id"></strong>
                            </span>
                        </div>

                       

                        <div class="form-group">
                          <label>Room No</label>
                            <select type="text" name="room_id" id="edit_room_id" class="form-control" required="required">
                             <option value="">Choose Option</option>
                            </select>
                            <span class="text-red">
                              <strong class="edit_room_id"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                          <label>Description</label>
                            <input type="text" class="form-control" id="edit_description" name="description" placeholder="Description" autocomplete="off" value="{{ old('description') }}" require >
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
      <!-- /.row --> 
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.25/angular.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('erp/app.js')}}" type="text/javascript"></script>

<script type="text/javascript">
 <!--------angular js ------>

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

<!------end angular js ------> 
// code for datatable fetch data
var dataTableRoute = "{{ route('itstation.fetch') }}";
var editRoute = "{{route('itstation.edit')}}";
var activeRoute = "{{route('itstation.active')}}";
var disableRoute = "{{route('itstation.disable')}}";
var token = '{{csrf_token()}}';
var data =[
            { "data": "id" },
            { "data": "station_number" },
            { "data": "floor_id" },
            { "data": "room_id" },
            { "data": "description" },
            { "data": "created_at" },
            { "data": "status" },
            { "data": "options" ,"orderable":false},
          ]
$( document ).ready(function() {
  InitTable();

});

$('#edit_diff_btn').click(function() {
     

     EditDifferentModel('#edit_diff_form','#edit_diff_model');

});


  $(document).on('change','.inventory_id',function(){
    var inventory_id = $(this).val();
    var id = '.'+$(this).attr('id');
      $.ajax({
              url: "{{route('itemSNOFetchByInventory')}}",
              data: { '_token': "{{csrf_token()}}",'inventory_id':inventory_id},
              type: 'POST',
              success: function (data) {
                // console.log(data); 
                var html = '';
                $.each(data, function(i, item) {
                  html+='<option value="'+item.id+'">';
                  html+=item.serial_no;
                  html+='</option>';

                });

                $(id).html(html);


              },
              error: function (xhr, status, error) {
                  
              }
      });

   });
$(document).on('change','#floor_id',function(){
    var floor_id = $(this).val();
      $.ajax({
              url: "{{route('roomFetchByFloor')}}",
              data: { '_token': "{{csrf_token()}}",'floor_id':floor_id},
              type: 'POST',
              success: function (data) {
                // console.log(data); 
                var html = '';
                $.each(data, function(i, row) {
                  html+='<option value="'+row.id+'">';
                  html+=row.room_no;
                  html+='</option>';

                });

                $('#room_id').html(html);


              },
              error: function (xhr, status, error) {
                  
              }
      });

   });

$(document).on('change','#edit_floor_id',function(){
    var floor_id = $(this).val();
      $.ajax({
              url: "{{route('roomFetchByFloor')}}",
              data: { '_token': "{{csrf_token()}}",'floor_id':floor_id},
              type: 'POST',
              success: function (data) {
                // console.log(data); 
                var html = '';
                $.each(data, function(i, row) {
                  html+='<option value="'+row.id+'">';
                  html+=row.room_no;
                  html+='</option>';

                });

                $('#edit_room_id').html(html);


              },
              error: function (xhr, status, error) {
                  
              }
      });

   });
</script>
@endsection