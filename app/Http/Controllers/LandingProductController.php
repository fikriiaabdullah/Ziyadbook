<?php

namespace App\Http\Controllers;

use App\Models\LandingProduct;
use App\Models\LandingProductImage;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LandingProductController extends Controller
{
    public function index()
    {
        $products = Product::with('landingPage')->paginate(10);
        return view('landing-products.index', compact('products'));
    }

    public function show(LandingProduct $landingProduct)
    {
        $product = $landingProduct->product;
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->limit(4)
            ->get();

        return view('landing-products.show', compact('landingProduct', 'product', 'relatedProducts'));
    }

    public function edit(Product $product)
    {
        $landingProduct = LandingProduct::firstOrNew(['product_id' => $product->id]);
        return view('landing-products.edit', compact('product', 'landingProduct'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'headline' => 'required|string|max:255',
            'subheadline' => 'nullable|string|max:255',
            'problem' => 'nullable|string',
            'agitate' => 'nullable|string',
            'solution' => 'nullable|string',
            'benefits' => 'nullable|string',
            'youtube_video_url' => 'nullable|string|max:255',
            'testimonials' => 'nullable|string',
            'call_to_action' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_captions.*' => 'nullable|string|max:255',
        ]);

        // Set is_active to false if not provided
        if (!isset($validated['is_active'])) {
            $validated['is_active'] = false;
        }

        $landingProduct = LandingProduct::firstOrNew(['product_id' => $product->id]);
        $landingProduct->fill($validated);
        $landingProduct->product_id = $product->id;
        $landingProduct->save();

        // Handle gallery images
        if ($request->hasFile('gallery_images')) {
            $images = $request->file('gallery_images');
            $captions = $request->input('image_captions', []);

            foreach ($images as $index => $image) {
                $imageName = 'landing_' . $product->id . '_' . time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('landing_images', $imageName, 'public');

                LandingProductImage::create([
                    'landing_product_id' => $landingProduct->id,
                    'image_path' => 'storage/' . $path,
                    'caption' => isset($captions[$index]) ? $captions[$index] : null,
                    'sort_order' => $index
                ]);
            }
        }

        return redirect()->route('landing-products.index', $product)
            ->with('success', 'Landing page updated successfully.');
    }

    public function destroy(LandingProduct $landingProduct)
    {
        $product = $landingProduct->product;

        // Delete all associated images
        foreach ($landingProduct->images as $image) {
            $this->deleteImage($image->id);
        }

        $landingProduct->delete();

        return redirect()->route('products.show', $product)
            ->with('success', 'Landing page deleted successfully.');
    }

    public function landing(Product $product)
    {
        $landingProduct = $product->landingPage;

        if (!$landingProduct || !$landingProduct->is_active) {
            return redirect()->route('shop.products.show', $product->id);
        }

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->limit(4)
            ->get();

        return view('landing-products.show', compact('landingProduct', 'product', 'relatedProducts'));
    }

    public function deleteImage($imageId)
    {
        $image = LandingProductImage::findOrFail($imageId);

        // Remove the file from storage
        $imagePath = str_replace('storage/', '', $image->image_path);
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        // Delete the record
        $image->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }

    public function reorderImages(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*' => 'required|integer|exists:landing_product_images,id',
        ]);

        foreach ($request->images as $index => $id) {
            LandingProductImage::where('id', $id)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
