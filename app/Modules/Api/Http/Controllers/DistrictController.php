<?php

namespace App\Modules\Api\Http\Controllers;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends AppController
{
    public function getDistrict(Request $request)
    {
        $city = City::where('name', $request->name)->first();
        $districts = District::where('parent_code', $city->code)->orderBy('name', 'asc')->get();

        return response()->json([
            'status' => 200,
            'message' => __('Thành công!'),
            'data' => $districts
        ]);
    }
}
