@extends('layouts.mainlayout')
@section('content')
    @if(session('success'))
        <script>
            $( document ).ready(function() {
                swal("Success", "{{session('success')}}", "success");
            });

        </script>
    @endif
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Add Call Back for Lead : {{$lead->businessName}} ({{$lead->user->fname}} {{$lead->user->lname}})</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{!! url('leads/storecallback'); !!}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="box-body" >

                <div class="row">
                    <!--lead_id against which recording will be stored -->
                    <input name='lead_id' type='hidden' value='<?php echo $lead_id; ?>' />
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="title" class="col-sm-3 control-label">Select Date</label>

                            <div class="col-sm-6">
                                <div>
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='date' class="form-control" name="appointdate" autocomplete="off" />
                                        <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                                    </div>
                                </div>


                                @if ($errors->has('appointdate'))
                                    <span class="text-red">
                              <strong>{{ $errors->first('appointdate') }}</strong>
                          </span>
                                @endif
                            </div>
                        </div>

                        @php

                            $time_zones = array('Select Zone','Pacific','Mountain','Centeral','Eastern','UK','Western','Eastern[Aus]');

                        @endphp

                        <div class="form-group">
                            <label for="time_zone" class="col-sm-3 control-label" >Time Zone</label>
                            <div class="col-sm-6">
                                <select name="time_zone" id="time_zone" class="form-control select2">
                                    <option value=""></option><option value="0" selected="selected">Select </option>

                                    @foreach($time_zones as $index => $zone)
                                        <option value="{{ $index + 1 }}">{{$zone}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('time_zone'))
                                    <span class="text-red">
                                  <strong>{{ $errors->first('time_zone') }}</strong>
                              </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Time" class="col-sm-3 control-label" >Time</label>
                            <div class="col-sm-6">
                                <select name="Time" id="Time" class="form-control">
                                </select>
                                @if ($errors->has('time_zone'))
                                    <span class="text-red">
                                  <strong>{{ $errors->first('time_zone') }}</strong>
                              </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="Pakistan Time" class="col-sm-3 control-label">Pakistan Time</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="appointtime" name="appointtime" placeholder="Start Date" autocomplete="off"  readonly="" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note" class="col-sm-3 control-label">Note</label>

                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" id="note" name="note" placeholder="Any note, please put here." rows="10">{{old('note')}}</textarea>
                                @if ($errors->has('note'))
                                    <span class="text-red">
        								  <strong>{{ $errors->first('note') }}</strong>
        							  </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Select Staff</label>

                            <div class="col-sm-9">
                                <select name="agentids[]" class="form-control" multiple id="selectAgents">
                                    @if(count($agents) > 0)
                                        @foreach($agents as $agent)
                                            <option value="{{$agent->id}}">{{$agent->fname}} {{$agent->lname}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('agentids'))
                                    <span class="text-red">
                              <strong>{{ $errors->first('agentids') }}</strong>
                          </span>
                                @endif
                            </div>
                        </div>


                    </div>
                </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{!! url('/leads/'); !!}/{{$lead_id}}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Add Call Back</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
    <script>
        $(document).ready(function() {

            jQuery('#time_zone').on('change',function(){

                var token = $("input[name='_token']").val();
                $.ajax({
                    url: "<?php echo route('time_zones') ?>",
                    dataType : 'json',
                    method: 'POST',
                    data: {

                        zone:jQuery(this).val(),
                        _token:token,

                    },
                    success: function(data) {
                        jQuery('#Time').html(data);
                        var html = '';
                        data.forEach(function(value,index){
                            html += `<option value="${value}">${value}</option>`;
                        });

                        jQuery('#Time').html(html);

                    }
                });
            });


            jQuery('#Time').on('change',function(){

                var token = $("input[name='_token']").val();
                $.ajax({
                    url: "<?php echo route('convertToPak') ?>",
                    dataType : 'text',
                    method: 'POST',
                    data: {

                        time:jQuery(this).val(),
                        zone:jQuery('#time_zone').val(),
                        _token:token,

                    },
                    success: function(data) {
                        jQuery('#appointtime').val(data);
                    }
                });
            });

            $("#selectAgents").select2({
                placeholder: "Select a Staff",
                allowClear: true
            });

        });
    </script>
@endsection