<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class MetricsChart extends Component
{
    public $labels;
    public $leads;
    public $sales;

    public function __construct()
    {
        $start = Carbon::now()->subMonths(6)->startOfMonth();
        $end = Carbon::now()->endOfMonth();
        $period = CarbonPeriod::create($start, '1 month', $end);

        $metricsPerMonth = collect($period)->map(function ($date) {
            return [
                'month' => $date->format('Y-m'),
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

        $this->labels = $metricsPerMonth->pluck('month');
        $this->leads = $metricsPerMonth->pluck('leads');
        $this->sales = $metricsPerMonth->pluck('sales');
    }

    public function render()
    {
        return view('components.metrics-chart');
    }
}
