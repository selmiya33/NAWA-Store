<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_first_name',
        'customer_lasst_name',
        'customer_email',
        'customer_phone',
        'customer_address',
        'customer_province',
        'customer_postal_code',
        'customer_code_country',
        'customer_city',
        'status',
        'payment_status',
        'total',
        'currency',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_lines')
            ->withPivot(['quantity', 'product_name', 'price'])
            ->using(OrderLine::class);
    }

    public function lines()
    {
        return $this->hasMany(OrderLine::class);
    }
}
