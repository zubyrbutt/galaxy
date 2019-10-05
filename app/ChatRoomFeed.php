<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoomFeed extends Model
{
    public function fromContact()
    {
        return $this->hasOne(ChatRoom::class, 'id', 'room_id');
    }
    public function user()
    {
    	return $this->hasOne(User::class,'id','sender_id');
    }
    public function room()
    {
    	return $this->hasOne(ChatRoom::class,'id','room_id');
    }
}
