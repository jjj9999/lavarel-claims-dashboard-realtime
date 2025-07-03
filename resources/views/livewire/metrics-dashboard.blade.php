<div>
    <div class="p-4 bg-gray-50 border-b border-gray-200 mt-4 mb-4">
        <input
            type="text"
            wire:model.debounce.300ms="search"
            placeholder="🔍 Search history..."
            class="w-full px-4 py-2 border rounded focus:outline-none focus:ring">
    </div>


    <div class="mt-8">
        <h3 class="text-lg font-bold mb-2 text-white">📊 Metrics History</h3>
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full w-full text-sm text-left">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 cursor-pointer" wire:click="sortBy('date')">⏱ Date</th>
                        <th class="p-2 cursor-pointer" wire:click="sortBy('timestamp')">⏱ Time</th>
                        <th class="p-2 cursor-pointer" wire:click="sortBy('pfas_cases')">🟢 PFAS Cases</th>
                        <th class="p-2 cursor-pointer" wire:click="sortBy('sales_today')">💰 Sales ($)</th>
                        <th class="p-2 cursor-pointer" wire:click="sortBy('leads_acquired')">💼 Leads Today</th>
                        <th class="p-2 cursor-pointer" wire:click="sortBy('leads_sold')">💰 Leads Sold</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rows as $row)
                    <tr class="border-t">
                        <td class="p-2">{{ $row['date'] }}</td>
                        <td class="p-2">{{ $row['timestamp'] }}</td>
                        <td class="p-2">{{ $row['pfas_cases'] }}</td>
                        <td class="p-2">${{ $row['sales_today'] }}</td>
                        <td class="p-2">{{ $row['leads_acquired'] }}</td>
                        <td class="p-2">{{ $row['leads_sold'] }}</td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-500">No history yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="flex justify-center items-center gap-4 mt-4">
                <button wire:click="previousPage" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300"
                    @disabled($page===1)>
                    ‹ Prev
                </button>

                <span class="text-sm text-gray-700">Page {{ $page }}</span>

                <button wire:click="nextPage"
                    class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300"
                    @if (count($rows) < 5) disabled @endif>
                    Next ›
                </button>
            </div>

        </div>
    </div>
</div>