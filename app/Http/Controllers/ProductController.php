<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();

        $test = Product::find(2);

        return view('product.index', compact('product', 'test'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();

        return view('product.form', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_product = [
            'name'          => $request->name,
            'description'   => $request->description,
            'enable'        => 1,
        ];

        $insert_product = Product::create($data_product);

        $data_category = [
            'product_id'    => $insert_product->id,
            'category_id'   => $request->category,
        ];

        $insert_category = ProductCategory::create($data_category);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image->storeAs('public/image', $image->hashName());

            $data_image = [
                'name'  => $image->hashName(),
                'file'  => $image->extension(),
                'enable'=> 1
            ];

            $insert_image = Image::create($data_image);

            $data_product_image = [
                'product_id'    => $insert_product->id,
                'image_id'      => $insert_image->id,
            ];

            $insert_product_image = ProductImage::create($data_product_image);
        }

        if($insert_product){
            return redirect()->route('product.index')->with('success', 'Success');
        }else{
            return redirect()->route('product.index')->with('error', 'Error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();

        return view('product.form', compact('product', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->name          = $request->name;
        $product->description   = $request->description;

        $product->save();

        if($request->category != $product->categoryProduct->category_id)
        {
            $category = ProductCategory::where('product_id', $id)->first();

            $category->category_id = $request->category;

            $category->save();
        }

        if ($request->hasFile('image')) {

            $product_image = ProductImage::where('product_id', $id)->first();

            if($product_image){
                if (Storage::exists('public/image/'.$product->imageProduct->image->name)) {
                    Storage::delete('public/image/'.$product->imageProduct->image->name);
                }

                $image = Image::findOrFail($product_image->image_id);

                $image->forceDelete();
                $product_image->forceDelete();
            }

            $image = $request->file('image');
            $image->storeAs('public/image', $image->hashName());

            $data_image = [
                'name'  => $image->hashName(),
                'file'  => $image->extension(),
                'enable'=> 1
            ];

            $insert_image = Image::create($data_image);

            $data_product_image = [
                'product_id'    => $product->id,
                'image_id'      => $insert_image->id,
            ];

            $insert_product_image = ProductImage::create($data_product_image);
        }

        if($product){
            return redirect()->route('product.index')->with('success', 'Success');
        }else{
            return redirect()->route('product.index')->with('error', 'Error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product_category = ProductCategory::where('product_id', $product->id)->first();
        if($product_category)
        {
            $product_category->forceDelete();
        }

        $product_image = ProductImage::where('product_id', $product->id)->first();
        if($product_image)
        {

            $image = Image::where('id', $product_image->image_id)->first();
            if($image)
            {
                if (Storage::exists('public/image/'.$product->imageProduct->image->name)) {
                    Storage::delete('public/image/'.$product->imageProduct->image->name);
                }
                $image->forceDelete();

            }


            $product_image->forceDelete();
        }

        $product->forceDelete();

        return redirect()->route('product.index')->with('success', 'Success');

    }
}
