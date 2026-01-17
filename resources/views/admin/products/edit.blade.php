@extends('layouts.admin')

@section('page-title', 'Edit Product')

@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Edit Product</h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">← Back to Products</a>
    </div>

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Category <span style="color: #dc3545;">*</span></label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Product Name <span style="color: #dc3545;">*</span></label>
            <input type="text" name="name" class="form-control" required value="{{ old('name', $product->name) }}">
        </div>

        <div class="form-group">
            <label>Description <span style="color: #dc3545;">*</span></label>
            <textarea name="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Price (₹) <span style="color: #dc3545;">*</span></label>
                <input type="number" step="0.01" name="price" class="form-control" required value="{{ old('price', $product->price) }}">
            </div>

            <div class="form-group">
                <label>Old Price (₹) - Optional</label>
                <input type="number" step="0.01" name="old_price" class="form-control" value="{{ old('old_price', $product->old_price) }}">
            </div>
        </div>

        <div class="form-group">
            <label>Available Sizes <span style="color: #dc3545;">*</span></label>
            <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-top: 10px;">
                @foreach(['M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL'] as $size)
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; padding: 10px 15px; border: 2px solid #ddd; border-radius: 5px;">
                        <input type="checkbox" name="available_sizes[]" value="{{ $size }}" {{ in_array($size, old('available_sizes', $product->available_sizes)) ? 'checked' : '' }}>
                        <span>{{ $size }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label>Current Primary Image</label>
            <div style="margin-bottom: 15px;">
                <img src="{{ asset('storage/' . $product->primary_image) }}" alt="{{ $product->name }}" style="width: 150px; height: 200px; object-fit: cover; border-radius: 8px;">
            </div>
            <label>Change Primary Image</label>
            <input type="file" name="primary_image" class="form-control" accept="image/*">
        </div>

        @if($product->images->count() > 0)
        <div class="form-group">
            <label>Additional Images</label>
            <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 15px;">
                @foreach($product->images as $image)
                    <div style="position: relative;">
                        <img src="{{ asset('storage/' . $image->image_path) }}" style="width: 100px; height: 133px; object-fit: cover; border-radius: 8px;">
                        <form action="{{ route('admin.products.deleteImage', $image) }}" method="POST" style="position: absolute; top: 5px; right: 5px;" onsubmit="return confirm('Delete this image?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: #dc3545; color: white; border: none; border-radius: 50%; width: 25px; height: 25px; cursor: pointer; font-size: 16px; line-height: 1;">×</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="form-group">
            <label>Add More Images</label>
            <input type="file" name="additional_images[]" class="form-control" accept="image/*" multiple>
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
            <div class="checkbox-group">
                <input type="checkbox" name="is_featured" id="is_featured" {{ $product->is_featured ? 'checked' : '' }}>
                <label for="is_featured">Featured Product</label>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" name="is_new_arrival" id="is_new_arrival" {{ $product->is_new_arrival ? 'checked' : '' }}>
                <label for="is_new_arrival">New Arrival</label>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" name="is_sold_out" id="is_sold_out" {{ $product->is_sold_out ? 'checked' : '' }}>
                <label for="is_sold_out">Sold Out</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="padding: 15px 40px; font-size: 16px;">Update Product</button>
    </form>
</div>

@endsection