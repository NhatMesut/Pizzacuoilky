<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'border_id',
        'topping_id',
        'quantity',
        'detail_product_id',
    ];

    public function detail_products(){
        return $this->belongsTo(DetailProduct::class, 'detail_product_id');
    }
    
    public function border(){
        return $this->belongsTo(Border::class);
    }

    public function topping(){
        return $this->belongsTo(Topping::class);
    }   
}
