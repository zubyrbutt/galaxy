<?php

namespace App\Http\Resources;

use App\ChatRoomFeed;
use App\UnReadMessage;
use Illuminate\Http\Resources\Json\JsonResource;

class Participant extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user_avatar="";
        $user_name="";
        $totalMesg =0;
        $user_dept ="";
        if($this->room_type=='Normal'){            
            foreach($this->participants as $user){
                if($user->user_id!=auth()->user()->id && $user->user_id!=0 && $user->user_id!=NULL){
                    $firstname = ($user->users->fname) ? $user->users->fname : '';
                    $lastname = ($user->users->lname) ? $user->users->lname : '';
                    $user_name=$firstname . ' ' . $lastname;
                    $user_avatar=$user->users->avatar;
                    $user_dept = $user->users->department->deptname;
                }
            }
        }

        $totalMesg = UnReadMessage::where('room_id',$this->id)
                                    ->where('user_id',auth()->user()->id)
                                    ->count();
        return [
            'id'=>$this->id,
            'room_id'=>$this->id,
            'room_type'=>$this->room_type,
            'createdby'=>$this->createdby,
            'roomname'=>  ($this->name) ? ($this->name) : $user_name ,
            'totalMesg'=>$totalMesg,
            'deptname' =>($user_dept) ? $user_dept : '',
            'user_avatar'=>($this->logo) ? $this->logo : $user_avatar,

        ];

    }
}
