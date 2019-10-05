<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }
}
