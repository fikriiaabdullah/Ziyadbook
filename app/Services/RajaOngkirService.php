<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class RajaOngkirService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = 'https://api.rajaongkir.com/starter/';
        $this->apiKey = env('RAJAONGKIR_API_KEY', '');
    }

    /**
     * Get all provinces
     */
    public function getProvinces()
    {
        return Cache::remember('rajaongkir_provinces', 86400, function () {
            $response = Http::withHeaders([
                'key' => $this->apiKey
            ])->get($this->baseUrl . 'province');

            if ($response->successful()) {
                $data = $response->json();
                return $data['rajaongkir']['results'] ?? [];
            }

            return [];
        });
    }

    /**
     * Get cities by province ID
     */
    public function getCities($provinceId = null)
    {
        $cacheKey = 'rajaongkir_cities' . ($provinceId ? '_' . $provinceId : '');

        return Cache::remember($cacheKey, 86400, function () use ($provinceId) {
            $params = [];
            if ($provinceId) {
                $params['province'] = $provinceId;
            }

            $response = Http::withHeaders([
                'key' => $this->apiKey
            ])->get($this->baseUrl . 'city', $params);

            if ($response->successful()) {
                $data = $response->json();
                return $data['rajaongkir']['results'] ?? [];
            }

            return [];
        });
    }

    /**
     * Get shipping cost
     */
    public function getCost($origin, $destination, $weight, $courier)
    {
        $cacheKey = "rajaongkir_cost_{$origin}_{$destination}_{$weight}_{$courier}";

        return Cache::remember($cacheKey, 3600, function () use ($origin, $destination, $weight, $courier) {
            $response = Http::withHeaders([
                'key' => $this->apiKey
            ])->post($this->baseUrl . 'cost', [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $weight,
                'courier' => $courier
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['rajaongkir']['results'] ?? [];
            }

            return [];
        });
    }

    /**
     * Get city name by ID
     */
    public function getCityName($cityId)
    {
        $cities = $this->getCities();
        foreach ($cities as $city) {
            if ($city['city_id'] == $cityId) {
                return $city['type'] . ' ' . $city['city_name'];
            }
        }
        return '';
    }

    /**
     * Get province name by ID
     */
    public function getProvinceName($provinceId)
    {
        $provinces = $this->getProvinces();
        foreach ($provinces as $province) {
            if ($province['province_id'] == $provinceId) {
                return $province['province'];
            }
        }
        return '';
    }
}
