<!DOCTYPE html>
<html>

<head>
    <title>Metrics Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="p-6">
    <h2>📊 Monthly Leads vs Sales</h2>
    <canvas id="metricsChart" height="100"></canvas>

    <script>
        const ctx = document.getElementById('metricsChart').getContext('2d');
        const chart = new Chart(ctx, {
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
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>