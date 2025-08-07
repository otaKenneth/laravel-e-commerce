<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsVariant extends Model
{
    use HasFactory;

    protected $fillable = ['variant_name'];

    public function attributes() {
        return $this->hasManyThrough(
            ProductsAttribute::class,
            Product::class,
            'id',
            'product_id',
            'product_id',
            'id'
        );
    }
}
