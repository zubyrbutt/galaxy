<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    
    public function participants()
    {
        return $this->hasMany(ChatRoomParticipant::class,'room_id','id');
    }

    public function users(){
    	return $this->hasOne(User::class,'user_id','id');
    }
}
