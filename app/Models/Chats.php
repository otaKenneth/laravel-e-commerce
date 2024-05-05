<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{
    use HasFactory;

    protected $table = 'chats';
    protected $with = ['messages', 'vendor'];
    
    public function messages ()
    {
        return $this->hasMany(ChatMessages::class, 'chat_id');
    }

    public function vendor()
    {
        return $this->hasOneThrough(Vendor::class, ChatMessages::class, 'chat_id', 'id', 'id', 'vendor_id');
    }
}
