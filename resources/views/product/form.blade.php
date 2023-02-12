@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.notif')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Product</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form action="{{ !empty($product) ? route('product.update', $product->id) : route('product.store') }}" method="post" enctype='multipart/form-data'>
                                @csrf
                                @if (!empty($product))
                                    @method('PUT')
                                @endif

                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Name<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" value="{{ !empty($product->name) ? $product->name : '' }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Description<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <textarea name="description" cols="30" rows="5" class="form-control" required>{{ !empty($product->description) ? $product->description : '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Category<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <select name="category" class="form-control" required>
                                            @forelse ($category as $item)
                                                <option value="{{ $item->id }}" {{ !empty($product->categoryProduct) && $product->categoryProduct->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @empty
                                                <option value="">No Data</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">image</span></label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="image" value="">

                                        @if(!empty($product->imageProduct->image))
                                            <br><img src="{{ Storage::url('public/image/').$product->imageProduct->image->name }}" class="square" width="300px">
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="" class="col-md-0 col-form-label"></label>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="submit" class="btn btn-default" onclick="window.history.back()">Cancel</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
