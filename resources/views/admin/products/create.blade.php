@extends('layouts.admin')

@section('page-title', 'Add New Product')

@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Add New Product</h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">← Back to Products</a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label>Category <span style="color: #dc3545;">*</span></label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Product Name <span style="color: #dc3545;">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="e.g., Elegant Mustard Ethnic Kurta Set" required value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label>Description <span style="color: #dc3545;">*</span></label>
            <textarea name="description" class="form-control" placeholder="Describe the product..." required>{{ old('description') }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Price (₹) <span style="color: #dc3545;">*</span></label>
                <input type="number" step="0.01" name="price" class="form-control" placeholder="2995.00" required value="{{ old('price') }}">
            </div>

            <div class="form-group">
                <label>Old Price (₹) - Optional</label>
                <input type="number" step="0.01" name="old_price" class="form-control" placeholder="3495.00" value="{{ old('old_price') }}">
                <small style="color: #666; font-size: 13px;">For showing discounts</small>
            </div>
        </div>

        <div class="form-group">
            <label>Available Sizes <span style="color: #dc3545;">*</span></label>
            <div style="display: flex; gap: 15px; flex-wrap: wrap; margin-top: 10px;">
                @foreach(['M', 'L', 'XL', '2XL', '3XL', '4XL', '5XL'] as $size)
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; padding: 10px 15px; border: 2px solid #ddd; border-radius: 5px; transition: all 0.3s;">
                        <input type="checkbox" name="available_sizes[]" value="{{ $size }}" {{ in_array($size, old('available_sizes', [])) ? 'checked' : '' }}>
                        <span>{{ $size }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label>Primary Image <span style="color: #dc3545;">*</span></label>
            <input type="file" name="primary_image" class="form-control" accept="image/*" required>
            <small style="color: #666; font-size: 13px;">This will be the main product image</small>
        </div>

        <div class="form-group">
            <label>Additional Images (Max 3)</label>
            <input type="file" name="additional_images[]" class="form-control" accept="image/*" multiple>
            <small style="color: #666; font-size: 13px;">You can select up to 3 additional images</small>
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
            <div class="checkbox-group">
                <input type="checkbox" name="is_featured" id="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                <label for="is_featured">Featured Product (Show in Best Sellers)</label>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" name="is_new_arrival" id="is_new_arrival" {{ old('is_new_arrival') ? 'checked' : '' }}>
                <label for="is_new_arrival">New Arrival</label>
            </div>

            <div class="checkbox-group">
                <input type="checkbox" name="is_sold_out" id="is_sold_out" {{ old('is_sold_out') ? 'checked' : '' }}>
                <label for="is_sold_out">Sold Out</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" style="padding: 15px 40px; font-size: 16px;">Create Product</button>
    </form>
</div>

@endsection