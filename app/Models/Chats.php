<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{
    use HasFactory;

    protected $table = 'chats';
    protected $with = ['messages'];
    
    public function messages ()
    {
        return $this->hasMany(ChatMessages::class, 'chat_id');
    }

    public function admin()
    {
        return $this->hasOneThrough(Admin::class, ChatMessages::class, 'chat_id', 'id', 'id', 'admin_id');
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, ChatMessages::class, 'chat_id', 'id', 'id', 'user_id');
    }
}
