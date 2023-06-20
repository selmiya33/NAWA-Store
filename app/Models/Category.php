<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
        protected $fillable =['name','image'];


        public function getImageUrlAttribute(){
            if ($this->image) {
                return Storage::disk('public')->url($this->image);
    
            }
            return 'https://placehold.co/100x100/orange/white?text=add+Image';
        }
}
