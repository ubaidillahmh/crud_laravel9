<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $fillable = [
        'name', 'enable'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function categoryProduct()
    {
        return $this->hasMany('App\Models\ProductCategory', 'category_id', 'id');
    }
}
