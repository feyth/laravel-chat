<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $table = "chats";

    public function fromUser()
    {
        return $this->belongsTo('App\User', 'from_user');
    }

    public function toUser()
    {
        return $this->belongsTo('App\User', 'to_user');
    }
}
