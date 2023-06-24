<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    

    protected $fillable =[
        'name_product','slug','price','description','short_description','status','category_id','comper_price','image'
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
            $query->where('user_id','=',1);

        });
    }

    //local scope
    public function scopeActive(Builder $query){
        $query->where('status','=','active');

    }

    public function scopeStatus(Builder $query, $status){
        $query->where('status','=', $status);

    }
}
