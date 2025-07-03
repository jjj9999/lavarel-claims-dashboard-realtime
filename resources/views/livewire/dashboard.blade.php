<link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
<div>
    <section class="info-box" aria-label="Application Information">
        Test dashboard application with meaningless mock data. Made by Justin van Dalen on 3-7-2025.
    </section>

    <header class="header-box" role="banner">
        <h1>PFAS DATA REAL-TIME</h1>
    </header>

    <div aria-label="Component Container">
        @livewire('real-time-metrics')
        @livewire('metrics-dashboard')
    </div>
</div>