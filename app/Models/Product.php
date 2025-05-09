<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'product_image', 'category_id', 'sold_as', 'weight', 'size',
        'composition', 'color', 'location', 'issues', 'original_price', 'retail_price'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * A product can belong to many orders.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class)
                    ->withPivot('quantity')
                    ->withTimestamps();
    }
}
