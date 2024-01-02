@extends('layouts.app')

@section('title', 'Home')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item active">Beranda</li>
    </ol>
@endsection
<style>/* Custom minimalistic select style */
.custom-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="%23343a40"><path d="M7 10l5 5 5-5z" /></svg>') no-repeat right 0.75rem center/12px 12px;
    padding-right: 2.25rem;  /* Set a specific width */
    width: 150px; /* Adjust the width as needed */
    display: inline-block;

}

/* Optional: Style the card container */
.card {
    transition: box-shadow 0.3s;
}

.card:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-header {
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}

.form-group {
    margin-bottom: 1rem;
}

.chart-canvas {
    width: 100%; /* Make the canvas fill its container */
    height: 200px; /* Set a fixed height for the chart canvas */
}


</style>
@section('content')
    <div class="container-fluid">
        @can('show_total_stats')
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-primary p-4 mfe-3 rounded-left">
                            <i class="bi bi-bar-chart font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-primary">{{ format_currency($revenue) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Pendapatan</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-warning p-4 mfe-3 rounded-left">
                            <i class="bi bi-arrow-return-left font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-warning">{{ format_currency($sale_returns) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Retur Penjualan</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-success p-4 mfe-3 rounded-left">
                            <i class="bi bi-arrow-return-right font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-success">{{ format_currency($purchase_returns) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Pengembalian Pembelian</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="card-body p-0 d-flex align-items-center shadow-sm">
                        <div class="bg-gradient-info p-4 mfe-3 rounded-left">
                            <i class="bi bi-trophy font-2xl"></i>
                        </div>
                        <div>
                            <div class="text-value text-info">{{ format_currency($profit) }}</div>
                            <div class="text-muted text-uppercase font-weight-bold small">Keuntungan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('show_weekly_sales_purchases|show_month_overview')
        <div class="row mb-4">
            @can('show_weekly_sales_purchases')
            <div class="col-lg-7">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-light border-0">
            <h5 class="mb-0">Penjualan & Pembelian</h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="month" class="sr-only">Pilih Bulan:</label>
                <select id="month" class="form-control custom-select">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">{{ bulan_indonesia($i) }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="year" class="sr-only">Pilih Tahun:</label>
                <select id="year" class="form-control custom-select">
                    @for ($i = date('Y'); $i >= 2022; $i--)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <canvas id="salesPurchasesChart" class="chart-canvas"></canvas>
        </div>
    </div>
</div>

            @endcan
            @can('show_month_overview')
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header ">
                    <h5 class="mb-0">  Hasil dari {{ bulan_indonesia(now()->format('n')) }}, {{ now()->format('Y') }}</h5>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <div class="chart-container" style="position: relative; height:auto; width:280px">
                            <canvas id="currentMonthChart"class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
        @endcan

        @can('show_monthly_cashflow')
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header">
                    <h5 class="mb-0">   Arus Kas Bulanan (Pembayaran Dikirim & Diterima)</h5>
                    
                    <h6><b>

                        {{ bulan_indonesia(now()->format('n')) }}, {{ now()->format('Y') }}</h6>
                    </b>
                    </div>
                    <div class="card-body">
                        <canvas id="paymentChart"class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endcan
    </div>
@endsection

@section('third_party_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.0/chart.min.js"
            integrity="sha512-asxKqQghC1oBShyhiBwA+YgotaSYKxGP1rcSYTDrB0U6DxwlJjU59B67U8+5/++uFjcuVM8Hh5cokLjZlhm3Vg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@push('page_scripts')
    @vite('resources/js/chart-config.js')
@endpush
