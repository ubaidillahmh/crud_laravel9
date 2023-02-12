@extends('layouts.app')

@section('content')
<div class="container">
    @include('partials.notif')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Category</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-responsive table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="73%">Category Name</th>
                                        <th colspan="2">Action</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($category as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td colspan="2"><form onsubmit="return confirm('Are you sure ?');" action="{{ route('category.destroy', $item->id) }}" method="POST">
                                                <a href="{{ route('category.edit', ['category' => $item->id]) }}" class="btn btn-warning">Edit</a> |
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
                            <a href="{{ route('category.create') }}" class="btn btn-primary">Add</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
