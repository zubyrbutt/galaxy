<?php 
$dated="";
    $showdate=1;
?>
@foreach($comment as $value)

 <?php

    if($dated==""){
        $dated=$value->created_at->format('d-M-Y');
        $showdate=1;
    }elseif($dated===$value->created_at->format('d-M-Y')){        
            $showdate=0;
    }else{
        $showdate=1;
        $dated=$value->created_at->format('d-M-Y');
    }
?>   


<ul class="timeline" id="timelinemore" data-next-page="">
            <!-- timeline time label -->
      @if($showdate===1)
    <!-- timeline time label -->
    <li class="time-label" >
        <span class="bg-red">
            {{$dated}}
        </span>
    </li>
    <!-- /.timeline-label -->
    @endif
      <!-- /.timeline-label -->
            <!-- timeline item -->
      <li>
        <i class="fa fa-envelope bg-blue"></i>

        <div class="timeline-item">
          <span class="time"><i class="fa fa-clock-o"></i> {{$value->created_at->format('H:i')}} </span>

          <h3 class="timeline-header"><a href="#">{{$value->user->fname}} {{$value->user->lname}}</a> </h3>

          <div class="timeline-body">
            {!! $value->comment !!}
            <?php 
                  if($value->status=='Pending') {
                  echo '<label class="label label-info pull-right">'.$value->status.'</label>';
                  }else if($value->status=='Closed') {
                  echo '<label class="label label-success pull-right">'.$value->status.'</label>';
                  }else if($value->status=='Forwarded') {
                  echo '<label class="label label-warning pull-right">'.$value->status.'</label>';
                  }else{
                  echo '<label class="label label-primary pull-right">'.$value->status.'</label>';
                  }
            ?>
            
          </div>

        </div>
      </li>
      <!-- END timeline item -->
      
@endforeach