<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'detailed_description',
        'image',
        'slug',
        'quantity',
        'tags',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function detail_products(){
        return $this->hasMany(DetailProduct::class);
    }

    public function product_borders(){
        return $this->hasMany(ProductBorder::class);
    }

    public function product_toppings(){
        return $this->hasMany(ProductTopping::class);
    }
}
