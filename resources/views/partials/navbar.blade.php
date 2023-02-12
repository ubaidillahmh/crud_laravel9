<li class="nav-item" {{ Route::is('product.index') ? 'active' : '' }}>
    <a class="nav-link" href="{{ route('product.index') }}">Product</a>
</li>
<li class="nav-item" {{ Route::is('category.index') ? 'active' : '' }}>
    <a class="nav-link" href="{{ route('category.index') }}">Category</a>
</li>
