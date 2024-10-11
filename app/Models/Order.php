<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'customer_id',
        'address',
        'phone',
        'payment',
        'total_amount',
        'status',
        'coupon_id',
        'created_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_code = self::generateOrderCode();
        });
    }

    private static function generateOrderCode()
    {
        return strtoupper(bin2hex(random_bytes(7))); // Tạo 14 ký tự ngẫu nhiên gồm số và chữ viết hoa
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
