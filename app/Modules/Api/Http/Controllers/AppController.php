<?php

namespace App\Modules\Api\Http\Controllers;

use App\Http\Controllers\Controller;

class AppController extends Controller
{
    public function response($status, $message = '', $data = [])
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

}
