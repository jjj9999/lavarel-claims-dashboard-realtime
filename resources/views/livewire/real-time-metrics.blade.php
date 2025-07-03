<div wire:poll.1s="refreshData" class="flex gap-6" wire:ignore.self>
    <div class="bg-white shadow-xl rounded-lg p-6 space-y-4 flex-shrink-0" style="width: 320px;">
        <h3 class="text-lg font-bold">Real-Time Metrics (Today)</h3>

        <div>🟢 PFAS Cases: <strong>{{ $data['pfas_cases'] }}</strong></div>
        <div>💰 Sales Today: <strong>${{ $data['sales_today'] }}</strong></div>
        <div>💼 Leads Today: <strong>{{ $data['leads_acquired'] }}</strong></div>
        <div>💰 Leads Sold: <strong>{{ $data['leads_sold'] }}</strong></div>

        <button wire:click="refreshData" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Manual Refresh
        </button>
    </div>
    <div class="chart-container">
        <x-metrics-chart />
    </div>
</div>