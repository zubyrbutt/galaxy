
@foreach($comment as $value)

    <!-- timeline time label -->
    <li class="time-label" >
        <span class="bg-red">
            {{$value->created_at->format('H:i')}}
        </span>
    </li>
    <!-- /.timeline-label -->
 

    <!-- timeline item -->
      <li>
        <i class="fa fa-envelope bg-blue"></i>

        <div class="timeline-item">
          <span class="time"><i class="fa fa-clock-o"></i> {{$value->created_at->format('H:i')}} </span>
          <div class="box">
          <h3 class="timeline-header"><a href="#">{{$value->user->fname}} {{$value->user->lname}}</a> Comment</h3>

          <div class="timeline-body">
              {!! $value->comment !!}
                
                <div class="clearfix"><br></div>
                <ul class="mailbox-attachments clearfix">
                 
                  </ul>
             
          </div>
         </div>
        </div>
      </li>

@endforeach