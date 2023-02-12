<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'image';
    protected $fillable = [
        'name', 'file', 'enable'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

    public function productImage()
    {
        return $this->hasOne('App\Models\ProductImage', 'id', 'image_id');
    }
}
