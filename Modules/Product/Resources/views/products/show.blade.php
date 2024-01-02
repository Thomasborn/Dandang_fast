@extends('layouts.app')

@section('title', 'Product Details')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Barang</a></li>
        <li class="breadcrumb-item active">Details</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid mb-4">
        <div class="row mb-3">
            <div class="col-md-12">
            <?php
    // Assuming $product->product_code is a string containing letters
    $productCode = strtoupper($product->product_code); // Convert to uppercase for consistency
    $numericProductCode = '';

    // Mapping of letters to numeric values
    $letterMapping = [
        'A' => '01', 'B' => '02', 'C' => '03', 'D' => '04', 'E' => '05',
        'F' => '06', 'G' => '07', 'H' => '08', 'I' => '09', 'J' => '10',
        'K' => '11', 'L' => '12', 'M' => '13', 'N' => '14', 'O' => '15',
        'P' => '16', 'Q' => '17', 'R' => '18', 'S' => '19', 'T' => '20',
        'U' => '21', 'V' => '22', 'W' => '23', 'X' => '24', 'Y' => '25', 'Z' => '26',
    ];

    // Convert each letter to its numeric equivalent
    for ($i = 0; $i < strlen($productCode); $i++) {
        $char = $productCode[$i];
        $numericProductCode .= isset($letterMapping[$char]) ? $letterMapping[$char] : $char;
    }
   // or $numericProductCode = str_pad((int) $product->product_code, 5, '0', STR_PAD_LEFT);
//    dd($numericProductCode);
    ?>
    {!! \Milon\Barcode\Facades\DNS1DFacade::getBarCodeSVG($numericProductCode, $product->product_barcode_symbology, 2, 110) !!}
</div>


        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped mb-0">
                                <tr>
                                    <th>Kode Barang</th>
                                    <td>{{ $product->product_code }}</td>
                                </tr>
                                <tr>
                                    <th>Barcode</th>
                                    <td>{{ $product->product_barcode_symbology }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $product->product_name }}</td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td>{{ $product->category->category_name }}</td>
                                </tr>
                                <tr>
                                    <th>Biaya</th>
                                    <td>{{ format_currency($product->product_cost) }}</td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td>{{ format_currency($product->product_price) }}</td>
                                </tr>
                                <tr>
                                    <th>Kuantita</th>
                                    <td>{{ $product->product_quantity . ' ' . $product->product_unit }}</td>
                                </tr>
                                <tr>
                                    <th>Stok</th>
                                    <td>
                                        COST:: {{ format_currency($product->product_cost * $product->product_quantity) }} /
                                        PRICE:: {{ format_currency($product->product_price * $product->product_quantity) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Pemberitahuan Stok</th>
                                    <td>{{ $product->product_stock_alert }}</td>
                                </tr>
                                <tr>
                                    <th>Tax (%)</th>
                                    <td>{{ $product->product_order_tax ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Tax Type</th>
                                    <td>
                                        @if($product->product_tax_type == 1)
                                            Exclusive
                                        @elseif($product->product_tax_type == 2)
                                            Inclusive
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Note</th>
                                    <td>{{ $product->product_note ?? 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card h-100">
                    <div class="card-body">
                        @forelse($product->getMedia('images') as $media)
                            <img src="{{ $media->getUrl() }}" alt="Product Image" class="img-fluid img-thumbnail mb-2">
                        @empty
                            <img src="{{ $product->getFirstMediaUrl('images') }}" alt="Product Image" class="img-fluid img-thumbnail mb-2">
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



