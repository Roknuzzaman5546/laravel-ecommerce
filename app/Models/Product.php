<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'subcategory_id', 'name', 'slug', 'description', 'image', 'old_price', 'new_price'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
