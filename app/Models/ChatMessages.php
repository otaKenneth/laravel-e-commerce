<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessages extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'user_id', 'admin_id', 'chat_id', 'from'];

    public function chat()
    {
        return $this->belongsTo(Chats::class);
    }
}
