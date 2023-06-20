<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class Product extends Model
{
    use HasFactory;

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

}
