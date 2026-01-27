@extends('layouts.admin')

@section('page-title', 'Products')

@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">All Products ({{ $products->total() }})</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Add New Product</a>
    </div>

    <div style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Sizes</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>
                        <img src="{{ asset('uploads/' . $product->primary_image) }}" alt="{{ $product->name }}">
                    </td>
                    <td>
                        <strong>{{ $product->name }}</strong><br>
                        @if($product->is_featured)
                            <span class="badge badge-primary">Featured</span>
                        @endif
                        @if($product->is_new_arrival)
                            <span class="badge badge-info">New</span>
                        @endif
                    </td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                        <strong style="color: #c2185b;">₹{{ number_format($product->price, 2) }}</strong>
                        @if($product->old_price)
                            <br><small style="text-decoration: line-through; color: #999;">₹{{ number_format($product->old_price, 2) }}</small>
                        @endif
                    </td>
                    <td>
                        <small>{{ implode(', ', $product->available_sizes) }}</small>
                    </td>
                    <td>
                        @if($product->is_sold_out)
                            <span class="badge badge-danger">Sold Out</span>
                        @else
                            <span class="badge badge-success">Available</span>
                        @endif
                    </td>
                    <td>{{ $product->view_count }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display: inline-block; margin-top: 5px;" onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" style="text-align: center; padding: 40px; color: #666;">
                        No products yet. <a href="{{ route('admin.products.create') }}">Add your first product</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $products->links() }}
    </div>
</div>

@endsection