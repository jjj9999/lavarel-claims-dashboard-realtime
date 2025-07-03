<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class RealTimeMetrics extends Component
{
    public $data = [
        'pfas_cases' => 0,
        'sales_today' => 0,
        'leads_acquired' => 0,
        'leads_sold' => 0,
    ];

    public $history = [];

    public function mount()
    {
        $this->refreshData();
    }

    public function refreshData()
    {
        $this->data = [
            'pfas_cases' => rand(10, 100),
            'sales_today' => rand(1000, 10000),
            'leads_acquired' => rand(100, 1000),
            'leads_sold' => rand(30, 75),
        ];

        // Append new data point with timestamp to history
        $this->history[] = array_merge($this->data, [
            'timestamp' => now()->format('H:i:s'),
            'date' => now()->toDateString(),
        ]);

        // Keep history to last 20 items max
        if (count($this->history) > 20) {
            array_shift($this->history);
        }

        for ($i = 6; $i >= 0; $i--) {  // last 7 days example
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $timestamps[] = $date;
            $leads[] = rand(40, 200);
            $sales[] = rand(1000, 10000);
        }

        // Emit relevant data to chart
        $this->dispatch('chartDataUpdated', [
            'timestamps' => array_column($this->history, 'timestamp'),
            'leads' => array_column($this->history, 'leads_acquired'),
            'sales' => array_column($this->history, 'sales_today'),
        ]);

        // Emit event to log history in the dashboard
        $this->dispatch('dataRefreshed', $this->data);
    }

    // Method for JS to get chart data
    public function getChartData()
    {
        return [
            'timestamps' => array_column($this->history, 'timestamp'),
            'leads' => array_column($this->history, 'leads_acquired'),
            'sales' => array_column($this->history, 'sales_today'),
        ];
    }

    public function render()
    {
        return view('livewire.real-time-metrics');
    }
}
