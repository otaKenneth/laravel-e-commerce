<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorSalesTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['date_range',
        'transaction_number',
        'amount',
        'status',
        'order_ids'
    ];
}
