<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <style>
        /* Add your custom styles for the PDF here */
        body {
            font-family: 'Arial', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            color: #333333;
        }

        /* Add more styles as needed */
    </style>
</head>
<body>

    <h1>Sales Report</h1>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>No Faktur</th>
                <th>Depo</th>
                <th>Sales</th>
                <th>Outlet</th>
                <th>Total</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sales as $sale)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($sale->date)->format('d M, Y') }}</td>
                    <td>{{ $sale->reference }}</td>
                    <td>{{ $sale->kode_depo }}</td>
                    <td>{{ $sale->kode_salesman }}</td>
                    <td>{{ $sale->customer_name }}</td>
                    <td>Rp {{ number_format($sale->total_amount / 10, 3) }}</td>
                    <td>
                        <a href="{{ route('sales.show', $sale->id) }}">
                            <img src="https://icons.veryicon.com/png/o/miscellaneous/simple-line-icon/view-details-4.png" 
                                alt="" style="max-width: 100%; height: 50px;">
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <span class="text-danger">No Sales Data</span>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
