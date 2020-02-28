<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expo extends Model
{
    protected $table = 'expos';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'whatsapp',
        'comment',
    ];
}
