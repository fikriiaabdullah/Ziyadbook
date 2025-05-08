<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RajaOngkirService;

class RajaOngkirController extends Controller
{
    protected $rajaOngkirService;

    public function __construct(RajaOngkirService $rajaOngkirService)
    {
        $this->rajaOngkirService = $rajaOngkirService;
    }

    /**
     * Get all provinces
     */
    public function provinces()
    {
        $provinces = $this->rajaOngkirService->getProvinces();
        return response()->json($provinces);
    }

    /**
     * Get cities by province
     */
    public function cities(Request $request)
    {
        $provinceId = $request->query('province_id');
        $cities = $this->rajaOngkirService->getCities($provinceId);
        return response()->json($cities);
    }

    /**
     * Calculate shipping cost
     */
    public function cost(Request $request)
    {
        $request->validate([
            'origin' => 'required',
            'destination' => 'required',
            'weight' => 'required|numeric|min:1',
            'courier' => 'required|in:jne,pos,tiki'
        ]);

        $costs = $this->rajaOngkirService->getCost(
            $request->origin,
            $request->destination,
            $request->weight,
            $request->courier
        );

        return response()->json($costs);
    }
}
