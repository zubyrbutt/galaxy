<?php
function makeLinks($str) {
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
    $urls = array();
    $urlsToReplace = array();
    if(preg_match_all($reg_exUrl, $str, $urls)) {
        $numOfMatches = count($urls[0]);
        $numOfUrlsToReplace = 0;
        for($i=0; $i<$numOfMatches; $i++) {
            $alreadyAdded = false;
            $numOfUrlsToReplace = count($urlsToReplace);
            for($j=0; $j<$numOfUrlsToReplace; $j++) {
                if($urlsToReplace[$j] == $urls[0][$i]) {
                    $alreadyAdded = true;
                }
            }
            if(!$alreadyAdded) {
                array_push($urlsToReplace, $urls[0][$i]);
            }
        }
        $numOfUrlsToReplace = count($urlsToReplace);
        for($i=0; $i<$numOfUrlsToReplace; $i++) {
            $str = str_replace($urlsToReplace[$i], "<a target='_blank' href=\"".$urlsToReplace[$i]."\">".$urlsToReplace[$i]."</a> ", $str);
        }
        return $str;
    } else {
        return $str;
    }
}

    $dated="";
    $showdate=1;
?>
@foreach($messages as $value)
    <?php

        if ($dated == "") {
            $dated = $value->created_at->format('d-M-Y');
            $showdate = 1;
        } elseif ($dated === $value->created_at->format('d-M-Y')) {
            $showdate = 0;
        } else {
            $showdate = 1;
            $dated = $value->created_at->format('d-M-Y');
        }
    ?>
    @if($showdate===1)

            <li class="time-label">
                        <span class="bg-red">
                            {{$dated}}
                        </span>
            </li>

    @endif

        <li>
            <i class="fa fa-envelope bg-blue"></i>

            <div class="timeline-item">
                <span class="time"><i class="fa fa-clock-o"></i> {{$value->created_at->format('H:i')}} </span>

                <h3 class="timeline-header"><a href="#">{{$value->user->fname}} {{$value->user->lname}}</a> posted with
                    @if($value->status=='closed_request')
                        <span class="label label-success">Closed</span>
                    @else
                        <span class="label label-primary">Progress</span>
                    @endif    
                    @if($value->external==1)
                        <span class="label label-info">External</span>
                    @endif
                </h3>

                <div class="timeline-body">
                    {!! html_entity_decode(nl2br(e(makeLinks($value->message)))) !!}
                    {{-- {!! $value->message !!} --}}
                    @if(count($value->assets)>0)
                        <div class="clearfix"><br></div>
                        <ul class="mailbox-attachments clearfix">
                            @foreach($value->assets as $asset)
                                <li>
                                    <div class="mailbox-attachment-info" style="width: 100%;">
                                        <p class="mailbox-attachment-name">{{$asset->orginalfilename}}</p>
                                        <span class="mailbox-attachment-size">

                                        <a href="{{Storage::disk('local')->url('public/ycc_support/'.$asset->id.'/messages/'.$asset->attachment)}}" target="_blank"
                                           class="btn btn-default btn-xs pull-right"><i
                                                    class="fa fa-cloud-download"></i></a>
                                      </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>

            </div>
        </li>


    @endforeach


