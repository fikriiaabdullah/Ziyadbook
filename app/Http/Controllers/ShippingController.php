<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingMethod;

class ShippingController extends Controller
{
    public function index()
    {
        $shippingMethods = ShippingMethod::orderBy('name')->paginate(10); // <- paginate!
        return view('shipping.index', compact('shippingMethods'));
    }

    public function create()
    {
        return view('shipping.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        ShippingMethod::create($request->only('name', 'price'));
        return redirect()->route('shipping.index')->with('success', 'Shipping method added.');
    }

    public function edit(ShippingMethod $shipping)
    {
        return view('shipping.edit', compact('shipping'));
    }

    public function update(Request $request, ShippingMethod $shipping)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $shipping->update($request->only('name', 'price'));
        return redirect()->route('shipping.index')->with('success', 'Shipping method updated.');
    }

    public function destroy(ShippingMethod $shipping)
    {
        $shipping->delete();
        return redirect()->route('shipping.index')->with('success', 'Shipping method deleted.');
    }
}
