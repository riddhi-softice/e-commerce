<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'type_id', 'category_id', 'sub_category_id',
        'brand_id', 'description', 'price'
    ];

    public function type() { return $this->belongsTo(Type::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function subCategory() { return $this->belongsTo(SubCategory::class); }
    public function brand() { return $this->belongsTo(Brand::class); }
    public function variants() { return $this->hasMany(ProductVariant::class); }
    public function media() { return $this->hasMany(ProductMedia::class); }
}

