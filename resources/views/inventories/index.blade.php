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
              <h3 class="box-title"> Inventory </h3>
              <span class="pull-right">
                <a href="#" class="btn btn-info addModelbtn" id="#addModel"><span class="fa fa-plus"></span> Add Inventory</a>
                
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
                  <th>Inventory Name</th>
                  <th>Category Name</th>
                  <th>Quantity</th>
                  <th>Created At</th>
                  <th>Status</th>
                  <th>Action</th>
                  
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
  <div class="modal fade" id="addModel" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Inventory Form</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('inventory.store')}}" class="form" id="add_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                  <div class="form-group">
                    <label>Item Name</label>
                      <input type="text" class="form-control"  name="title" placeholder="Item Name" autocomplete="off" value="{{ old('category_name') }}" require >
                      <span class="text-red">
                                <strong class="title"></strong>
                      </span>
                      @if ($errors->has('title'))
                            <span class="text-red">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                  </div>
                       
                        <div class="form-group">
                            <label>Category Name</label>
                            <select type="text" name="category_id"  class="form-control" required="required">
                              <option value="">Choose Category</option>
                              @foreach($categories as $row)
                              <option value="{{$row->id}}">{{$row->category_name}}</option>
                              @endforeach
                            </select>
                            <span class="text-red">
                              <strong class="category_id"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                          <label>Quantity</label>
                            <input type="text" class="form-control"  name="quantity" placeholder="Quantity" autocomplete="off" value="{{ old('quantity') }}" require='require' >
                            <span class="text-red">
                                      <strong class="quantity"></strong>
                            </span>
                            @if ($errors->has('quantity'))
                                  <span class="text-red">
                                      <strong>{{ $errors->first('quantity') }}</strong>
                                  </span>
                              @endif
                        </div>

                        <div class="form-group">
                          <label>Price</label>
                            <input type="text" class="form-control"  name="price" placeholder="Price" autocomplete="off" value="{{ old('price') }}" require >
                            <span class="text-red">
                                      <strong class="price"></strong>
                            </span>
                            @if ($errors->has('price'))
                                  <span class="text-red">
                                      <strong>{{ $errors->first('price') }}</strong>
                                  </span>
                              @endif
                        </div>

                        <div class="form-group">
                          <label>Description</label>
                            <input type="text" class="form-control" name="description" placeholder="Description" autocomplete="off" value="{{ old('description') }}" require >
                            <span class="text-red">
                                      <strong class="description"></strong>
                            </span>
                            @if ($errors->has('description'))
                                  <span class="text-red">
                                      <strong>{{ $errors->first('description') }}</strong>
                                  </span>
                              @endif
                        </div>
                        <!--- Inventory Specification -->
                        <div class="form-group">
                          <label>Specification</label>
                            <div ng-app="app" ng-controller="MyCtrl">
                             <table  class="table table-striped table-bordered">
                               <thead>
                                  
                                  <tr>
                                      <th>Attribute Name</th>
                                      <th>Attribute Value</th>
                                      <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                 <tr ng-repeat="name in data.names track by $index">
                                     <td> <input type="text" ng-model="data.names1[$index].name" name="attribute_name[]" required="required"  style="width:100%;"></td>
                                    <td> <input type="text" ng-model="data.names3[$index].name" name="attribute_value[]" required="required" style="width:100%;"></td>

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
<!--                         <div class="col-sm-3"></div>
 -->                        
                            <span class="button-checkbox">
                            <button type="button" class="btn btn-default" data-color="primary"><i class="state-icon glyphicon glyphicon-unchecked"></i>&nbsp;Consumable</button>
                            <input type="checkbox" class="hidden"  name="consumable" value="Yes">
                            </span>
                         
                      </div>


                        <div class="form-group">
                            <label>Status</label>
                            <select type="text" name="status"  class="form-control" required="required">
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
          <h4 class="modal-title">Inventory Form</h4>
        </div>
        <div class="modal-body">
          
          <form action="{{route('inventory.store')}}" class="form" id="edit_diff_form" method="POST">
               @csrf   
                <div class="modal-body" id="modalbody">
                       
                  <div class="form-group">
                    <label>Item Name</label>
                      <input type="text" class="form-control" id="edit_title" name="title" placeholder="Item Name" autocomplete="off" value="{{ old('category_name') }}" require >
                      <span class="text-red">
                                <strong class="edit_title"></strong>
                      </span>
                      @if($errors->has('title'))
                            <span class="text-red">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                  </div>
                       
                        <div class="form-group">
                            <label>Category Name</label>
                            <select type="text" name="category_id" id="edit_category_id" class="form-control" required="required">
                              <option value="">Choose Category</option>
                              @foreach($categories as $row)
                              <option value="{{$row->id}}">{{$row->category_name}}</option>
                              @endforeach
                            </select>
                            <span class="text-red">
                              <strong class="edit_category_id"></strong>
                            </span>
                        </div>

                        <!-- <div class="form-group">
                          <label>Quantity</label>
                            <input type="text" class="form-control" id="edit_quantity" name="quantity" placeholder="Quantity" autocomplete="off" value="{{ old('quantity') }}" require >
                            <span class="text-red">
                                      <strong class="edit_quantity"></strong>
                            </span>
                            @if ($errors->has('quantity'))
                                  <span class="text-red">
                                      <strong>{{ $errors->first('quantity') }}</strong>
                                  </span>
                              @endif
                        </div> -->

                        <div class="form-group">
                          <label>Price</label>
                            <input type="text" class="form-control" id="edit_price" name="price" placeholder="Price" autocomplete="off" value="{{ old('price') }}" require >
                            <span class="text-red">
                                      <strong class="edit_price"></strong>
                            </span>
                            @if ($errors->has('price'))
                                  <span class="text-red">
                                      <strong>{{ $errors->first('price') }}</strong>
                                  </span>
                              @endif
                        </div>

                        <div class="form-group">
                          <label>Description</label>
                            <input type="text" class="form-control" id="edit_description" name="description" placeholder="Description" autocomplete="off" value="{{ old('description') }}" require >
                            <span class="text-red">
                                      <strong class="edit_description"></strong>
                            </span>
                            @if ($errors->has('description'))
                                  <span class="text-red">
                                      <strong>{{ $errors->first('description') }}</strong>
                                  </span>
                              @endif
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select type="text" name="status" id="edit_status" class="form-control" required="required">
                              <option value="Active">Active</option>
                              <option value="Disable">Disable</option>
                            </select>
                            <span class="text-red">
                              <strong class="edit_status"></strong>
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

var dataTableRoute = "{{ route('inventory.fetch') }}";
var editRoute = "{{route('inventory.edit')}}";
var activeRoute = "{{route('inventory.active')}}";
var disableRoute = "{{route('inventory.disable')}}";
var token = '{{csrf_token()}}';
var data =[
            { "data": "id" },
            { "data": "title" },
            { "data": "category_id" },
            { "data": "quantity" },
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
@endsection