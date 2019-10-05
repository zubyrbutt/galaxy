<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QualityAssurance extends Model
{
    public function created_by()
    {
        return $this->belongsTo(User::class, 'createdby', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function qa_attachments()
    {
        return $this->hasMany(QualilyAssuranceAttachments::class, 'qa_id', 'id')->orderBy('type');
    }
}
