<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Metric;

class MetricsApiController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pfas_cases'      => 'required|integer|min:0',
            'sales_today'     => 'required|numeric|min:0',
            'leads_acquired'  => 'required|integer|min:0',
            'leads_sold'      => 'required|integer|min:0',
        ]);

        $metric = Metric::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Metric recorded successfully.',
            'data' => $metric,
        ], 201);
    }
}

