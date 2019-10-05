@extends('layouts.mainlayout')
@section('content')
@if(session('success'))
    <script>
      $( document ).ready(function() {
        swal("Success", "{{session('success')}}", "success");
      });
      
    </script>
@endif
<?php
$user = Auth::user();
?>
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
<div id="PrintArea">
    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">My Profile</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" >
            <div class="row">
              <div class="col-md-4 text-center">
                  <div class="kv-avatar">
                          <img src="{{ asset('img/staff/'.$user->avatar) }}" width="90%">
                  </div>
              </div> 
              <div class="col-md-8">
              <table class="table table-striped">
                <tr>
                    <td><b>First Name</b></td>
                    <td>{{$user->fname}}</td>
                </tr>
                <tr>
                    <td><b>Last Name</b></td>
                    <td>{{$user->lname}}</td>
                </tr>
                <tr>
                    <td><b>Email</b></td>
                    <td>{{$user->email}}</td>
                </tr>
                <tr>
                    <td><b>Blood Group</b></td>
                    <td>{{$user->staffdetails->bloodgroup}}</td>
                </tr>
                <tr>
                    <td><b>Date of Birth</b></td>
                    <td>{{$user->staffdetails->dob}}</td>
                </tr>
                <tr>
                    <td><b>CNIC</b></td>
                    <td>{{$user->staffdetails->cnic}}</td>
                </tr>
                <tr>
                    <td><b>Status</b></td>
                    <td>
                        @if ($user->status === 1)
                          <span class="text-green"><b>Active</b></span>
                        @else
                            <span class="text-red"><b>Deactive</b></span>
                        @endif
                    </td>
                </tr>
                
              </table>
                  

              </div>
              </div>

          </div>

</div>



<!-- address row begins -->
<div class="row">
    <div class="col-md-6">
    <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Present Address</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                          <tr>
                            <td>Street Address 1</td>
                            <td>{{ $user->staffdetails->cstreetaddress }}</td>
                          </tr>
                          <tr>
                              <td>Street Address 2</td>
                              <td>{{ $user->staffdetails->cstreetaddress2 }}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{ $user->staffdetails->ccity }}</td>
                              </tr>
                        </table>
                    </div>
                </div>
            </div>
    </div>
    </div>
  
    
    <div class="col-md-6">
            <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Permanent Address</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <tr>
                                  <td>Street Address 1</td>
                                  <td>{{ $user->staffdetails->pstreetaddress }}</td>
                                </tr>
                                <tr>
                                    <td>Street Address 2</td>
                                    <td>{{ $user->staffdetails->pstreetaddress2 }}</td>
                                  </tr>
                                  <tr>
                                      <td>City</td>
                                      <td>{{ $user->staffdetails->pcity }}</td>
                                    </tr>
                              </table>           
                        </div>
                        </div>
                      </div>
            </div>
            </div>
        </div>
<!-- address now end-->

<!-- Gaurdian Info row begins -->
<div class="row">
        <div class="col-md-6">
        <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Gaurdian Info</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">

                            <table class="table table-striped">
                                <tr>
                                  <td>Father/Gaurdian Name</td>
                                  <td>{{ $user->staffdetails->gaurdianname }}</td>
                                </tr>
                                <tr>
                                    <td>Relationship</td>
                                    <td>{{ $user->staffdetails->gaurdianrelation }}</td>
                                  </tr>
                                  <tr>
                                      <td>Contact Number</td>
                                      <td>{{ $user->staffdetails->gaurdiancontact }}</td>
                                    </tr>
                              </table>
                        </div>
                    </div>
                </div>
        
        </div>
        </div>
        
        <div class="col-md-6">
                <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Personal Contact Info</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-striped">
                                    <tr>
                                      <td>Landline Number</td>
                                      <td>{{ $user->staffdetails->landline }}</td>
                                    </tr>
                                    <tr>
                                      <td>Mobile Number</td>
                                      <td>{{ $user->staffdetails->phonenumber }}</td>
                                    </tr>
                                  </table>
                            </div>
                            </div>
                
                        </div>
                
                </div>
                </div>
            </div>
<!-- Gaurdian Info now end-->

<!-- Regarding User row begins -->
<div class="row">
    <div class="col-md-6">
    <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">User Department & Role</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <tr>
                              <td>Deparment</td>
                              <td>{{$user->department->deptname}}</td>
                            </tr>
                            <tr>
                                <td>Designation</td>
                                <td>{{$user->designation->name}}</td>
                              </tr>
                              <tr>
                                  <td>User Role</td>
                                  <td>{{$user->role->role_title}}</td>
                                </tr>
                          </table>
                    </div>
                </div>
            </div>
    </div>
    </div>
    
    <div class="col-md-6">
            <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">User Account Info</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                            </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped">
                                <tr>
                                  <td>Email</td>
                                  <td>{{ $user->email }}</td>
                                </tr> 
                                <tr>
                                  <td>Status</td>
                                  <td>
                                      @if ($user->status === 1)
                                        <span class="text-green"><b>Active</b></span>
                                      @else
                                        <span class="text-red"><b>Deactive</b></span>
                                      @endif  
                                  </td>
                                </tr>
                              </table>
                        </div>
                        </div>
                    </div>
            
            </div>
            </div>
        </div>
<!-- Regarding User now end-->

<!-- Other Info & Settings begins -->
<div class="row">
        <div class="col-md-12">
        <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Settings & Other Info</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        
                        <div class="col-md-12">

                            <table class="table table-striped">
                                <tr>
                                  <td>Passport No. </td>
                                  <td>{{ $user->staffdetails->passportno }}</td>
                                </tr>
                                <tr>
                                  <td>Shift</td>
                                  <td>{{ $user->staffdetails->shift }}</td>
                                </tr>
                                <tr>
                                  <td>Timing</td>
                                  <td>{{ $user->staffdetails->starttime }} - {{ $user->staffdetails->endtime }}</td>
                                </tr>
                                <tr>
                                  <td>Extension No.</td>
                                  <td>{{$user->staffdetails->extension}}</td>
                                </tr>
                                <tr>
                                  <td>Joining Date</td>
                                  <td>{{$user->staffdetails->joiningdate}}</td>
                                </tr>
                              </table>                            
    
                        </div>
                    </div>
        
                </div>
        </div>
        </div>
        
</div>
<!-- Other Info & Settings end-->
</div>

<!-- Attendance Logs begins -->
<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Attendance</h3>
        <div class="box-tools pull-right">
            <input class="custom-input" type="month" name="srchmonth" id="srchmonth" autocomplete="off"  min="2019-01" max="{{date('Y-m')}}"  value="{{date('Y-m')}}" />
            <button class="btn btn-success" id="filterDept"><li class="fa fa-search"></li></button>
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body" style="">
            @if(count($attlog) > 0)
                <table id="attlogs" class="display responsive wrap" style="width:100%;">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Check-Out Marked</th>
                    <th>Tardies</th>
                    <th>Short Leave</th>
                    <th>Hours Worked</th>
                    <th>Remarks</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $tardies=0;
                  $absents=0;
                  $shortleaves=0;
                  $upleaves=0;
                  $deducteddays=0;
                  $unpaiddays=0;
                  $totaldays=0;
                ?>
                @foreach($attlog as $att)
                    <?php
                        if($att->dayname=='Sun'){
                            $class="bg-green";
                          if($att->status=='-'){  
                            $unpaiddays++;
                          }
                        }elseif($att->status=='Holiday'){
                            $class="bg-green";
                        }elseif($att->status=='X'){
                            $class="bg-red";
                            $absents++;
                        }elseif($att->status=='UL'){
                          $class="";
                          $upleaves++;
                        }elseif($att->status=='-'){
                          $class="";
                          $unpaiddays++;
                        }else{
                            $class="";
                        }
                        $totaldays++;
                        $tardies+=$att->tardies;
                        $shortleaves+=$att->shortleaves;
                    ?>
                    <tr class="{{$class}}">
                    <td>{{$att->dated->format('d-m-Y')}}</td>
                    <td>{{$att->dayname}}</td>
                    <td>{{$att->checkin}}</td>
                    <td>{{$att->checkout}}</td>
                    <td>{{$att->checkoutfound}}</td>
                    <td>{{$att->tardies}}</td>
                    <td>{{$att->shortleaves}}</td>
                    <td>{{$att->workedhours}}</td>
                    <td>{{$att->remarks}}</td>
                    <td>{{$att->status}}</td>
                    </tr>
                    @endforeach			  
                    <?php
                      //Tardy conversion to deducted days
                      $deducteddays+=intdiv($tardies,$settings['tardydaydeduct']);
                      //Short leaves conversion to deducted days
                      $deducteddays+=intdiv($shortleaves,$settings['shortleavedaydeduct']);
                      //Absents + Unpaid Leave + Unpaid days
                      $deducteddays+=$absents+$upleaves+$unpaiddays;
                    ?>
                </tbody>
                <tfoot>
                </tfoot>
                </table>

        <!-- Salary data widgets begins -->
        <div class="clearfix"><br></div>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Working Days</span>
                <span class="info-box-number" style="font-size: 20px;" >{{$totaldays}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text">Late Comming</span>
                  <span class="info-box-number">{{$tardies}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-aqua">
              <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Short Leaves</span>
                <span class="info-box-number">{{$shortleaves}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-red">
              <span class="info-box-icon"><i class="fa fa-clock-o"></i></span>
  
              <div class="info-box-content">
                  <span class="info-box-text">Unpaid Days</span>
                  <span class="info-box-number">{{$deducteddays}}</span>          
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-green">
              <span class="info-box-icon"><i class="fa fa-money"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Basic Salary</span>
                <span class="info-box-number">{{$user->staffdetails->salary}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
              <span class="info-box-icon"><i class="fa fa-money"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Recurring Commission</span>
                <span class="info-box-number">{{$salaries['rec_comm']}}</span>               
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
              <span class="info-box-icon"><i class="fa fa-money"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Ref Commission</span>
              <span class="info-box-number">{{$salaries['ref_comm']}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-yellow">
              <span class="info-box-icon"><i class="fa fa-money"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Demo Commission</span>
                <span class="info-box-number">{{$salaries['demo_comm']}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          
        </div>
        
        <!-- Salary data widgets ends -->

                @else
                <div>No Record found.</div>
                @endif

    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix" style="">
    </div>
    <!-- /.box-footer -->
</div>
<!-- Attendance Logs ends -->

<!-- Adjustments begins -->
<div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Adjustments</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body" style="">
              @if(count($adjustments) > 0)
                <table id="loginlogs" class="display responsive wrap" style="width:100%;">
                  <thead>
                  <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Created At</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($adjustments as $adjustment)
                    <tr>
                      <td>{{$adjustment->dated->format('d-M-Y')}}</td>
                      <td>
                          @if($adjustment->type==1)
                            Addition
                          @else
                            Deduction
                          @endif
                      </td>
                      <td>{{$adjustment->description}}</td>
                      <td>{{$adjustment->amount}}</td>
                      <td>{{$adjustment->status}}</td>
                      <td>{{$adjustment->createdby->fname}} {{$adjustment->createdby->lname}}</td>
                      <td>{{$adjustment->created_at->format('d-M-Y')}}</td>
                    </tr>
                    @endforeach			  
                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
                @else
                <div>No Record found.</div>
                @endif
  
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix" style="">
    </div>
    <!-- /.box-footer -->
  </div>
  <!-- Adjustments ends -->



 <!-- Edit Modal Begins -->   
 <div class="modal fade" id="modal-default-edit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Attendance</h4>
        </div>
        <div class="modal-body">
          <form role="form" action="{{route('attendancesheet.update')}}" method="POST" id="frmEdit">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <input name="id" id="editid" type="hidden" value="0">
            <div class="box-body">
              <div class="form-group">
                <label for="dated">Date</label>
                <input type="text" class="form-control" id="dated" name="dated"  autocomplete="off" readonly>
              </div>
              <div class="form-group">
                <label for="checkin">Check In</label>
                <input type="text" class="form-control" id="checkin" name="checkin" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="checkout">Check Out</label>
                <input type="text" class="form-control" id="checkout" name="checkout" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="checkoutfound">Check Out Marked</label>
                <select class="form-control" id="checkoutfound" name="checkoutfound">
                  <option value="Yes" selected>Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group">
                <label for="shortleaves">Short Leave</label>
                <input type="number" class="form-control" id="shortleaves" name="shortleaves" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="tardies">Tardy</label>
                <input type="number" class="form-control" id="tardies" name="tardies" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="workedhours">Worked Hours</label>
                <input type="number" class="form-control" id="workedhours" name="workedhours" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="remarks">Remarks</label>
                <input type="text" class="form-control" id="remarks" name="remarks" autocomplete="off" required>
              </div>
              <div class="form-group">
                <label for="status">Select Status</label>
                <select class="form-control" id="status" name="status">
                  <option value="P" selected>Present</option>
                  <option value="SL">Sick Leave</option>
                  <option value="CL">Causal Leave</option>
                  <option value="UL">Unpaid Leave</option>
                  <option value="X">Absent</option>
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

<script>
$(document).ready(function (e) {
  $(".loading").fadeOut();
  //Attendance Filter begins
  $('#filterDept').click( function() {
    var url;
    if($('#srchmonth').val()!=""){
      url="{{url('profile')}}/?srchmonth="+$('#srchmonth').val();
    }else{
      url ="{{url('profile')}}";
    }
    window.location.href =url;
  });

  
  });


</script>
@endpush
