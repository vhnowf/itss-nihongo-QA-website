<?php

namespace App\Modules\Api\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends AppController
{
    public function index(Request $request)
    {
        $cities = City::get();

        return response()->json([
            'status' => 200,
            'message' => __('Thành công!'),
            'data' => $cities,
        ]);
    }

    public function autoComplete(Request $request)
    {
        $cities = City::where('name', 'like', '%'.$request->name.'%')->get();

        return response()->json([
            'status' => 200,
            'message' => __('Thành công!'),
            'data' => $cities,
        ]);
    }
}
