<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getGeoJSON()
    {
        $provinces = Provinsi::get();
        $features = $provinces->map(function ($data) {
            return [
                'type' => 'Feature',
                'properties' => [
                    'name' => $data->name,
                    'alt_name' => $data->alt_name,
                    'latitude' => $data->latitude,
                    'longitude' => $data->longitude,
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$data->longitude, $data->latitude]
                ],
            ];
        });

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features,
        ]);
    }
}
