<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashierSale extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'total_price',
        'user_id'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class); // CashierSale belongs to Product
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
