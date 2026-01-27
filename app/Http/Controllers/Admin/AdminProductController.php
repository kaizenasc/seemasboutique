<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'available_sizes' => 'required|array',
            'primary_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // Upload primary image
        $primaryImagePath = $request->file('primary_image')->store('products', 'public');

        // Calculate discount
        $discount = null;
        if ($request->old_price && $request->old_price > $request->price) {
            $discount = round((($request->old_price - $request->price) / $request->old_price) * 100);
        }

        // Create product
        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'discount_percentage' => $discount,
            'available_sizes' => $request->available_sizes,
            'primary_image' => $primaryImagePath,
            'is_sold_out' => $request->has('is_sold_out'),
            'is_featured' => $request->has('is_featured'),
            'is_new_arrival' => $request->has('is_new_arrival')
        ]);

        // Upload additional images
        if ($request->hasFile('additional_images')) {
            $order = 1;
            foreach ($request->file('additional_images') as $image) {
                $imagePath = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                    'order' => $order++
                ]);
            }
        }

        // Update category product count
        $category = Category::find($request->category_id);
        $category->increment('product_count');

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'available_sizes' => 'required|array',
            'primary_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'old_price' => $request->old_price,
            'available_sizes' => $request->available_sizes,
            'is_sold_out' => $request->has('is_sold_out'),
            'is_featured' => $request->has('is_featured'),
            'is_new_arrival' => $request->has('is_new_arrival')
        ];

        // Calculate discount
        if ($request->old_price && $request->old_price > $request->price) {
            $data['discount_percentage'] = round((($request->old_price - $request->price) / $request->old_price) * 100);
        } else {
            $data['discount_percentage'] = null;
        }

        // Upload new primary image
        if ($request->hasFile('primary_image')) {
            Storage::disk('public')->delete($product->primary_image);
            $data['primary_image'] = $request->file('primary_image')->store('products', 'public');
        }

        $product->update($data);

        // Upload new additional images
        if ($request->hasFile('additional_images')) {
            $order = $product->images()->max('order') + 1;
            foreach ($request->file('additional_images') as $image) {
                $imagePath = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $imagePath,
                    'order' => $order++
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Delete images
        Storage::disk('public')->delete($product->primary_image);
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        // Update category product count
        $product->category->decrement('product_count');

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    public function deleteImage(ProductImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Image deleted successfully!');
    }
}