<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    // use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'name', 'description', 'enable'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function categoryProduct()
    {
        return $this->hasOne(ProductCategory::class, 'product_id', 'id');
    }

    public function imageProduct()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'id');
    }
}
