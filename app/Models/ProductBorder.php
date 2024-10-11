<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBorder extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'border_id',
    ];

    public function border(){
        return $this->belongsTo(Border::class);
    }
}
