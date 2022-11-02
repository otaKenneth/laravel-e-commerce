<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;


    // Note!!: Total B.S.!!
    // Relationship of a Vendor `vendors` with VendorsBusinessDetail `vendors_business_details` (every product belongs to a vendor)    // https://www.youtube.com/watch?v=uu8CBDsWD7g&list=PLLUtELdNs2ZaAC30yEEtR6n-EPXQFmiVu&index=109
    public function vendorbusinessdetails() { // vendor() in the SINGULAR!    // A Product `products` belongs to a Vendor `vendors`, and the Foreign Key of the Relationship is the `vendor_id` column
        return $this->belongsTo('App\Models\VendorsBusinessDetail', 'id', 'vendor_id'); // 'vendor_id' is the Foreign Key of the Relationhip
    }

}
