<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'name_product','slug','price','description','short_description','status','category_id','comper_price',
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


}
