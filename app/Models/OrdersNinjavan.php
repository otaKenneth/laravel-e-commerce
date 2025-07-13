<?php 
// In app/Models/OrderNinjavan.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class OrdersNinjavan extends Model
{

    
    // Use correct table name if it doesn't follow Laravel's plural convention
    protected $table = 'orders_ninjavan';

    // If you want to allow mass assignment for specific fields
  protected $fillable = [
    'order_id',
    'merchant_order_number',
    'service_level',
    'pickup_date',
    'pickup_time_start',
    'pickup_time_end',
    'pickup_instructions',
    'delivery_start_date',
    'delivery_time_start',
    'delivery_time_end',
    'delivery_instructions',
    'weight',
    'item_description',
    'quantity',
];

    // If the table doesn't use created_at and updated_at timestamps
    public $timestamps = true;

    // Relationships (optional but recommended)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}