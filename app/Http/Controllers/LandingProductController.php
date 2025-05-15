<?php

namespace App\Http\Controllers;

use App\Models\LandingProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        ]);

        // Set is_active to false if not provided
        if (!isset($validated['is_active'])) {
            $validated['is_active'] = false;
        }

        $landingProduct = LandingProduct::firstOrNew(['product_id' => $product->id]);
        $landingProduct->fill($validated);
        $landingProduct->product_id = $product->id;
        $landingProduct->save();

        return redirect()->route('landing-products.index', $product)
            ->with('success', 'Landing page updated successfully.');
    }

    public function destroy(LandingProduct $landingProduct)
    {
        $product = $landingProduct->product;
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
}
