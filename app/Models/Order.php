<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'payment_method',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ Order has many OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // ✅ If you want to access products directly via order
    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            OrderItem::class,
            'order_id',     // Foreign key on OrderItem table
          // Foreign key on Product table
            'id',           // Local key on Order table
            'product_id'    // Local key on OrderItem table
        );
    }

    public function status()
{
    return $this->belongsTo(Status::class);
}

public function items()
{
    return $this->hasMany(OrderItem::class);
}
}
