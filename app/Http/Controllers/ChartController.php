<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function showMetricsChart()
    {
        $start = Carbon::now()->subMonths(6)->startOfMonth();
        $end = Carbon::now()->endOfMonth();
        $period = CarbonPeriod::create($start, '1 month', $end);

        $metricsPerMonth = collect($period)->map(function ($date) {
            $month = $date->format('Y-m');
            return [
                'month' => $month,
                'leads' => DB::table('metrics')
                            ->whereYear('created_at', $date->year)
                            ->whereMonth('created_at', $date->month)
                            ->sum('leads_acquired'),
                'sales' => DB::table('metrics')
                            ->whereYear('created_at', $date->year)
                            ->whereMonth('created_at', $date->month)
                            ->sum('sales_today'),
            ];
        });

        $labels = $metricsPerMonth->pluck('month');
        $leads = $metricsPerMonth->pluck('leads');
        $sales = $metricsPerMonth->pluck('sales');

        return view('chart.metrics', compact('labels', 'leads', 'sales'));
    }
}
