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
        // Create uploads/products directory if doesn't exist
        if (!file_exists(public_path('uploads/products'))) {
            mkdir(public_path('uploads/products'), 0755, true);
        }

        // Save with unique name
        $primaryImageName = time() . '_' . uniqid() . '.' . $request->file('primary_image')->extension();
        $request->file('primary_image')->move(public_path('uploads/products'), $primaryImageName);
        $primaryImagePath = 'products/' . $primaryImageName;        

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
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(public_path('uploads/products'), $imageName);
                $imagePath = 'products/' . $imageName;
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
            // Delete old image
if (file_exists(public_path('uploads/' . $product->primary_image))) {
    unlink(public_path('uploads/' . $product->primary_image));
}

// Upload new image
$primaryImageName = time() . '_' . uniqid() . '.' . $request->file('primary_image')->extension();
$request->file('primary_image')->move(public_path('uploads/products'), $primaryImageName);
$data['primary_image'] = 'products/' . $primaryImageName;
        }

        $product->update($data);

        // Upload new additional images
        if ($request->hasFile('additional_images')) {
            $order = $product->images()->max('order') + 1;
            foreach ($request->file('additional_images') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
$image->move(public_path('uploads/products'), $imageName);
$imagePath = 'products/' . $imageName;
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
        // Delete primary image
if (file_exists(public_path('uploads/' . $product->primary_image))) {
    unlink(public_path('uploads/' . $product->primary_image));
}

// Delete additional images
foreach ($product->images as $image) {
    if (file_exists(public_path('uploads/' . $image->image_path))) {
        unlink(public_path('uploads/' . $image->image_path));
    }
}

        // Update category product count
        $product->category->decrement('product_count');

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }

    public function deleteImage(ProductImage $image)
    {
        if (file_exists(public_path('uploads/' . $image->image_path))) {
    unlink(public_path('uploads/' . $image->image_path));
}
        $image->delete();

        return back()->with('success', 'Image deleted successfully!');
    }
}