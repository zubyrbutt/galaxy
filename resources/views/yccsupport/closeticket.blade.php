<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" href="http://dinus.org/assets/mail/mailtip.css"/>
<script type="text/javascript" src="http://dinus.org/assets/mail/jquery.mailtip.js"></script>

    <style type="text/css">
        .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{
            border: unset;
        }
         .outer {
          display: table;
          position: absolute;
          top: 0;
          left: 0;
          height: 100%;
          width: 100%;
        }

        .middle {
          display: table-cell;
          vertical-align: middle;
        }

        .inner {
          margin-left: auto;
          margin-right: auto;
          width: 50%;
          /*whatever width you want*/
        }
    </style>


<div class="outer">
  <div class="middle">
    <div class="inner">
      {{-- <div class="jumbotron text-xs-center"> --}}





<div class="panel panel-default">
                    <div class="panel-body ">
                        <h4 class="text-center">Your Feedback means a lot to us</h4>
                        <hr>
                        <form method="post" action="{{ route('yccsubmitfeedback') }}">
                           @csrf
                           <input type="hidden" name="support_id" value="{{$support_id}}">
                            <table class="table">
                                <tr>
                                    <td>
                                        <label>Remarks</label>
                                        <select class="form-control" name="rating" required>
                                           <option value="satisfied">Satisfied</option>
                                           <option value="not_satisfied">Not Satisfied</option>
                                           <option value="poor_service">Poor Service</option>
                                        </select>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        <label>Feedback</label>
                                        <textarea name="feedback" class="form-control" rows="4" placeholder="Message text . . ."></textarea required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit" class="btn btn-danger btn-sm" style="width: 100%;"><i class="fa fa-envelope-o" style="padding-right: 5px;"></i> Send</button>
                                    </td>
                                </tr>
                            </table>

                        </form>
                    </div>
            </div>




            
    </div>
  </div>
</div>

