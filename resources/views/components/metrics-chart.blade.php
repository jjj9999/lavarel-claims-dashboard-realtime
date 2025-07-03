<div class="flex-grow bg-white shadow-xl rounded-lg p-6 flex flex-col" wire:ignore style="height: 300px;">
    <h3 class="text-lg font-bold mb-4">📈 Leads vs Sales Over Time</h3>
    <canvas id="metricsChart" style="position: relative; height: 300px;"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('metricsChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    // These errors do not actually trigger. Seems to be a version mismatch which wouldn't exist in a more advanced Lavarel setup
                    labels: @json($labels),
                    datasets: [{
                            label: 'Leads Acquired',
                            // These errors do not actually trigger. Seems to be a version mismatch which wouldn't exist in a more advanced Lavarel setup
                            data: @json($leads),
                            borderColor: 'blue',
                            backgroundColor: 'rgba(0, 0, 255, 0.1)',
                            fill: false,
                            tension: 0.1
                        },
                        {
                            label: 'Sales Today',
                            // These errors do not actually trigger. Seems to be a version mismatch which wouldn't exist in a more advanced Lavarel setup
                            data: @json($sales),
                            borderColor: 'red',
                            backgroundColor: 'rgba(255, 0, 0, 0.1)',
                            fill: false,
                            tension: 0.1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</div>