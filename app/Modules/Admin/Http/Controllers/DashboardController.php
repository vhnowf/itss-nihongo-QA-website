<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends AppController
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        if ($request->has('start')) {
            $startDate = Carbon::parse($request->get('start'));
        } else {
            $startDate = Carbon::now()->startOfMonth();
            // $startDate = Carbon::now();
        }

        if ($request->has('end')) {
            $endDate = Carbon::parse($request->get('end'));
        } else {
            $endDate = Carbon::now()->endOfMonth();
            // $endDate = Carbon::now()->subDays(30);
        }

        $countData = [
            'user' => User::where([
                    ['created_at', '<=', $endDate],
                    ['created_at', '>=', $startDate],
                ])->count(),
        ];
        
        return view('Admin::dashboards.index', compact('countData', 'startDate', 'endDate'));
    }
}
