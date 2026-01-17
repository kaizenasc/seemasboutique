@extends('layouts.admin')

@section('page-title', 'Add New Category')

@section('content')

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Add New Category</h2>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">← Back to Categories</a>
    </div>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Category Name <span style="color: #dc3545;">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="e.g., Festive Wear" required value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label>Icon (Emoji)</label>
            <input type="text" name="icon" class="form-control" placeholder="e.g., 🎊" maxlength="10" value="{{ old('icon') }}">
            <small style="color: #666; font-size: 13px;">Use any emoji or leave blank</small>
        </div>

        <div class="checkbox-group">
            <input type="checkbox" name="is_active" id="is_active" checked>
            <label for="is_active">Active (visible on website)</label>
        </div>

        <button type="submit" class="btn btn-primary">Create Category</button>
    </form>
</div>

@endsection