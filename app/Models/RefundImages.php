<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefundImages extends Model
{
    use HasFactory;

    protected $fillable = ['refund_id', 'image'];

    public function refund() {
        return $this->belongsTo(Refunds::class, 'refund_id');
    }
}
