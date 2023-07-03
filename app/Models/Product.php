<?php

namespace App\Models;

use NumberFormatter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable =[
        'name_product','slug','price','description','short_description','status','category_id','comper_price','image','user_id'
    ];

    // protected $guarded=['id'];//غير محبذة في الإستخدام

    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'Draft';
    const STATUS_ARCHIVED = 'Archived';

    public static function statusOpations(){
        return [
            self::STATUS_DRAFT => 'Draft',
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_ARCHIVED => 'Archived'
        ];

    }

    public function category(){
        return $this->belongsTo(Category::class)->withDefault(["name"=>"NoCategory"]);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    //Attribute accessors get----Attributenn//img_url
    public function getImageUrlAttribute(){
        if ($this->image) {
            return Storage::disk('public')->url($this->image);

        }
        return 'https://placehold.co/100x100/orange/white?text=add+Image';
    }
    // public function getName_ProductAttribute($value){
    //     return ucwords($value);

    // }

    public function getPriceFormattedAttribute(){
        $foramtter = new NumberFormatter(config('app.local'),NumberFormatter::CURRENCY);
        return $foramtter->formatCurrency($this->price, 'USD');

    }

    public function getComperPriceFormattedAttribute(){
        $foramtter = new NumberFormatter(config('app.local'),NumberFormatter::CURRENCY);
        return $foramtter->formatCurrency($this->comper_price, 'USD');

    }

    //global scope
    protected static function booted()
    {
        static::addGlobalScope('owner',function(Builder $query){
            $query->where('user_id','=', Auth::id());

        });
    }

    //local scope
    public function scopeActive(Builder $query){
        $query->where('status','=','active');

    }

    public function scopeStatus(Builder $query, $status){
        $query->where('status','=', $status);

    }

    public function scopeFilter(Builder $query, array $filters){
        $query->when($filters['search'] ?? false,function($query,$value){
            $query->where(function($query) use ($value){
                $query->where('products.name_product','LIKE',"%{$value}%")
                ->orwhere('products.description','LIKE',"%{$value}%");
            });
        })
        ->when($filters['stutas'] ?? false ,function($query,$value){
            $query->where('products.status','=',"$value");
        })
        ->when($filters['range_price'] ?? false ,function($query,$value){
            $query->where('products.price','=',"$value");
        });
    }
}
