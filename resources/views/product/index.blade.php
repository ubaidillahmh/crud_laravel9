@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.notif')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Product</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-responsive table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="33%">Name</th>
                                        <th width="15%">Category</th>
                                        <th width="27%">Image</th>
                                        <th width="35%" colspan="2">Action</th>
                                        <th width="20%"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($product as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->categoryProduct->category->name ?? '' }}</td>
                                            <td>
                                                @if (!empty($item->imageProduct->image->name))
                                                    <img src="{{ Storage::url('public/image/').$item->imageProduct->image->name }}" class="square" style="width: 150px">
                                                @endif
                                            </td>
                                            <td colspan="2"><form onsubmit="return confirm('Are you sure ?');" action="{{ route('product.destroy', $item->id) }}" method="POST">
                                                <a href="{{ route('product.edit', $item->id) }}" class="btn btn-warning">Edit</a> |
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" align="center">No Data</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <a href="{{ route('product.create') }}" class="btn btn-primary">Add</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
