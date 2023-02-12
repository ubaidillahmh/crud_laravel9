@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.notif')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Category</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <form action="{{ !empty($category) ? route('category.update', $category->id) : route('category.store') }}" method="post">
                                @csrf
                                @if (!empty($category))
                                    @method('PUT')
                                @endif

                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Category Name<span class="text-danger">*</span></label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="category_name" value="{{ !empty($category) ? $category->name : '' }}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-md-0 col-form-label"></label>
                                    <div class="col-md-9">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <button type="button" class="btn btn-default" onclick="window.history.back()">Cancel</button>

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
