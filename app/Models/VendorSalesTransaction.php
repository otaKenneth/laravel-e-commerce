<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorSalesTransaction extends Model
{
    use HasFactory;
    protected $table = 'vendor_sales_transaction';

    protected $fillable = ['vendor_bank_details_id','date_range',
        'transaction_number',
        'amount',
        'status',
        'order_ids'
    ];
}
