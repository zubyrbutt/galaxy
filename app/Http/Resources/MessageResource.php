<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'room_id'    =>$this->room_id,
            'roomtype'   =>$this->room->room_type,
            'roomname'   =>($this->room->name) ? ucfirst($this->room->name) : "",
            'sender_id'  =>$this->sender_id,
            'sender_avatar' =>$this->user->avatar,
            'sender_name' =>$this->user->fname . ' ' .$this->user->lname,
            'message'    => ($this->message) ? $this->message : 'nomesg',
            'file'    => ($this->file) ? $this->file : 'nofile',
            'created_at' => $this->created_at->format('d-M-Y h:i:s'),
            'send_time' => $this->created_at->diffForHumans(),
            'updated_at' => $this->updated_at->format('d-M-Y h:i:s'),

        ];
    }
}
