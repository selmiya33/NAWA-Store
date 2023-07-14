<?php

namespace App\Models;

use NumberFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Request;

class Product extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name_product',
        'slug',
        'price',
        'description',
        'short_description',
        'status',
        'category_id',
        'comper_price',
        'image',
        'user_id'
    ];

    protected $appends = [
        'image_url',
        'price_formatted',
        'comper_price_formatted',
    ];
    protected $hidden = [
        'image',
        'updated_at',
        'deleted_at'
    ];

    // protected $guarded=['id'];//غير محبذة في الإستخدام

    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'Draft';
    const STATUS_ARCHIVED = 'Archived';

    public static function statusOpations()
    {
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_ARCHIVED => 'Archived'
        ];
    }

    //**************Relations*******************
    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault(["name" => "NoCategory"]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gallery()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'carts', 'product_id', 'user_id', 'id', 'id')
            ->withPivot(['quantity'])
            ->withTimestamps()
            ->using(Cart::class);
    }

    // *********************Attribute accessors*******************
    public function getImageUrlAttribute() //img_url
    {
        if ($this->image) {

            return Storage::disk('public')->url($this->image);
        }
        return 'https://placehold.co/100x100/orange/white?text=Image';
    }

    // public function getName_ProductAttribute($value){
    //     return ucwords($value);

    // }

    public function getPriceFormattedAttribute()
    {
        $foramtter = new NumberFormatter(config('app.local'), NumberFormatter::CURRENCY);
        return $foramtter->formatCurrency($this->price, 'USD');
    }

    public function getComperPriceFormattedAttribute()
    {
        $foramtter = new NumberFormatter(config('app.local'), NumberFormatter::CURRENCY);
        return $foramtter->formatCurrency($this->comper_price, 'USD');
    }

    public function getDiscountAttribute()
    {
        if ($this->comper_price) {
            $discount = ($this->comper_price - $this->price);
            $foramtter = new NumberFormatter(config('app.local'), NumberFormatter::CURRENCY);
            return $foramtter->formatCurrency($discount, 'USD');
        } else {
            return 'No Discount Now';
        }
    }



    //******************global scope************************
    // protected static function booted()
    // {
    //     static::addGlobalScope('owner',function(Builder $query){
    //         $query->where('user_id','=', Auth::id());

    //     });
    // }

    //********************local scope************************
    public function scopeActive(Builder $query)
    {
        $query->where('status', '=', 'active');
    }

    public function scopeStatus(Builder $query, $status)
    {
        $query->where('status', '=', $status);
    }

    public function scopeFilter(Builder $query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $value) {
            $query->where(function ($query) use ($value) {
                $query->where('products.name_product', 'LIKE', "%{$value}%")
                    ->orwhere('products.description', 'LIKE', "%{$value}%");
            });
        })
            ->when($filters['stutas'] ?? false, function ($query, $value) {
                $query->where('products.status', '=', "$value");
            })
            ->when($filters['range_price'] ?? false, function ($query, $value) {
                $query->where('products.price', '=', "$value");
            });
    }
}
