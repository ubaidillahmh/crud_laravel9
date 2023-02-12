<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use App\Models\ProductCategory;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::with('categoryProduct.category', 'imageProduct.image')->get();

        if($data)
        {
            $return = array(
                'status'    => 'success',
                'data'      => $data
            );
        }else{
            $return = array(
                'status'    => 'success',
                'message'      => 'data not found'
            );
        }

        return response()->json($return);
    }

    public function show($id)
    {
        $data = Product::with('categoryProduct.category', 'imageProduct.image')->findOrFail($id);

        if($data)
        {
            $return = array(
                'status'    => 'success',
                'data'      => $data
            );
        }else{
            $return = array(
                'status'    => 'success',
                'message'      => 'data not found'
            );
        }

        return response()->json($return);
    }
}
