<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Cart extends Pivot
{
    use HasFactory;
    use HasUuids;
    protected $filable =['user_id','product_id','quantity'];
    protected $table = 'carts';

    // public function uniqueIds()
    // {
    //     return[
    //         'id'
    //     ];
    // }

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
