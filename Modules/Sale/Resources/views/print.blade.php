<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sale Details</title>
    <link rel="stylesheet" href="{{ public_path('b3/bootstrap.min.css') }}">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .card-body {
            padding: 30px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            margin: 20px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .invoice-header img {
            width: 180px;
        }

        .invoice-header h4 {
            margin-bottom: 20px;
        }

        .info-section h5 {
            margin: 0;
            padding-bottom: 5px;
            border-bottom: 2px solid #343a40;
        }

        .info-section p {
            margin-bottom: 10px;
        }

        .table-responsive-sm {
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #dee2e6;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #343a40;
            color: #fff;
        }

        .total-section {
            margin-top: 25px;
        }

        .footer-section {
            margin-top: 25px;
            text-align: center;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="card-body">
        <div class="invoice-header">
            <img src="{{ public_path('images/logo-dark.png') }}" alt="Logo">
            <h4><span>Reference::</span> <strong>{{ $sale->reference }}</strong></h4>
        </div>

        <div class="row info-section">
            <div class="col-sm-4 mb-3 mb-md-0">
                <h5>Sales Info:</h5>
                <p><strong>{{ $saler->Kode }}</strong></p>
                <p>Nama : {{ $saler->Nama }}</p>
            </div>

            <div class="col-sm-4 mb-3 mb-md-0">
                <h5>Outlet Info:</h5>
                <p><strong>{{ $customer->customer_name }}</strong></p>
                <p>{{ $customer->address }}</p>
                <p>Alamat: {{ $customer->address }}</p>
                <p>Kontak: {{ $customer->customer_phone }}</p>
            </div>

            <div class="col-sm-4 mb-3 mb-md-0">
                <h5>Invoice Info:</h5>
                <p>Invoice: <strong>INV/{{ $sale->reference }}</strong></p>
                <p>Date: {{ \Carbon\Carbon::parse($sale->date)->format('d M, Y') }}</p>
                <p>Status: <strong>{{ $sale->status }} / @if($sale->status == 'completed') Selesai @endif</strong></p>
                <p>Status Pembayaran: <strong>{{ $sale->payment_status }} /
                    @if($sale->payment_status == 'Paid') Lunas @endif
                </strong></p>
            </div>
        </div>

        <div class="table-responsive-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="align-middle">Barang</th>
                        <th class="align-middle">Harga Unit</th>
                        <th class="align-middle">Kuantitas</th>
                        <th class="align-middle">Diskon</th>
                        <th class="align-middle">Pajak</th>
                        <th class="align-middle">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sale->saleDetails as $item)
                        <tr>
                            <td class="align-middle">
                                {{ $item->product_name }} <br>
                                <span class="badge badge-success">
                                    {{ $item->product_code }}
                                </span>
                            </td>

                            <td class="align-middle">Rp {{ number_format($item->unit_price / 10, 3) }}</td>

                            <td class="align-middle">
                                {{ $item->quantity }}
                            </td>

                            <td class="align-middle">
                                {{ format_currency($item->product_discount_amount) }}
                            </td>

                            <td class="align-middle">
                                Rp {{ number_format($item->product_tax_amount / 10, 3) }}
                            </td>

                            <td class="align-middle">
                                Rp {{ number_format($item->sub_total / 10, 3) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row total-section">
            <div class="col-lg-4 col-sm-5 ml-md-auto">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="left"><strong>Diskon ({{ $sale->discount_percentage }}%)</strong></td>
                            <td class="right">{{ format_currency($sale->discount_amount) }}</td>
                        </tr>
                        <tr>
                            <td class="left"><strong>Pajak ({{ $sale->tax_percentage }}%)</strong></td>
                            <td class="right"> Rp {{ number_format($sale->tax_amount / 10, 3) }}</td>
                        </tr>
                        <tr>
                            <td class="left"><strong>Grand Total</strong></td>
                            <td class="right"><strong> {{ format_currency($sale->total_amount)}}
                            </strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row footer-section">
            <div class="col-xs-12">
                <p>{{ settings()->company_name }} &copy; {{ date('Y') }}.</p>
            </div>
        </div>
    </div>
</body>
</html>
