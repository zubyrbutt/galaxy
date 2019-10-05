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

    <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add New YCC Lead</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="{!! url('/yccleads'); !!}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="box-body" >
			
            <div class="row">			
                <div class="col-md-12">
                    <h3 class="box-title">Lead Information</h3>
                </div>
			<!-- Customer Info -->	
              <div class="col-md-12">
                <div class="form-group">
                  <label for="name" class="col-sm-3 control-label">Name</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="First Name" autocomplete="off" value="{{ old('name') }}" require >
                    @if ($errors->has('name'))
                          <span class="text-red">
                              <strong>{{ $errors->first('name') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}" autocomplete="off" require>
                    @if ($errors->has('email'))
                          <span class="text-red">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="contactno" class="col-sm-3 control-label">Contact No.</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="contactno" name="contactno" placeholder="Contact No" value="{{ old('contactno') }}" autocomplete="off" require>
                    @if ($errors->has('contactno'))
                          <span class="text-red">
                              <strong>{{ $errors->first('contactno') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="country" class="col-sm-3 control-label">Country</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="{{ old('country') }}" autocomplete="off" require>
                    @if ($errors->has('country'))
                          <span class="text-red">
                              <strong>{{ $errors->first('country') }}</strong>
                          </span>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                <label for="subject" class="col-sm-3 control-label">Subject</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" value="{{ old('subject') }}" autocomplete="off">
                    @if ($errors->has('subject'))
                        <span class="text-red">
                            <strong>{{ $errors->first('subject') }}</strong>
                        </span>
                    @endif
                </div>
                </div>

                <div class="form-group">
                <label for="subject" class="col-sm-3 control-label">Message</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" id="message" name="message" placeholder="Message" value="{{ old('message') }}" autocomplete="off">
                    @if ($errors->has('message'))
                        <span class="text-red">
                            <strong>{{ $errors->first('message') }}</strong>
                        </span>
                    @endif
                </div>
                </div>

                <div class="form-group">
                    <label for="subject" class="col-sm-3 control-label">Reffered By</label>    
                    <div class="col-sm-9">
                        <select name="refcode" class="form-control">
                            <option value="">None</option>
                            <option value="4">Farrukh Gondal</option>
                            <option value="5">Khuala Ahmed</option>
                            <option value="6">Shehnoor Ahmed</option>
                            <option value="7">Usama Awais</option>
                        </select>
                    </div>
                    </div>

                <div class="form-group">
                <label for="source" class="col-sm-3 control-label">Source</label>

                <div class="col-sm-9">
                    <input type="text" class="form-control" id="source" name="source" placeholder="Enter Source i.e Chat, Call" value="{{ old('source') }}" autocomplete="off">
                    @if ($errors->has('source'))
                        <span class="text-red">
                            <strong>{{ $errors->first('source') }}</strong>
                        </span>
                    @endif
                </div>
                </div>

			</div>
							
            
			
           
              </div>

          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{!! url('yccleads'); !!}" class="btn btn-default">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Add</button>
              </div>
              <!-- /.box-footer -->
            </form>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function() { 
    $('.select2').select2({
        multiple: false,
    }); 
});
</script>
@endpush