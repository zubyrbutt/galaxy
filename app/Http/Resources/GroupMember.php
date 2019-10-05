<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupMember extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'room_id'  =>$this->room_id,
            'user_id'  =>$this->user_id,
            'user_name'=>$this->users->fname.' '.$this->users->lname,
            'avatar'=>($this->users->avatar) ? $this->users->avatar : 'default_avatar_male.jpg',
            // 'user_name'=>$this->users->fname,
        ];
    }
}
