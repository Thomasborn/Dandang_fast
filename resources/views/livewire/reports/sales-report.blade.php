

<div>
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <form wire:submit="generateReport">
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Tanggal Mulai<span class="text-danger">*</span></label>
                                    <input wire:model="start_date" type="date" class="form-control" name="start_date">
                                    @error('start_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                <label>Tanggal Selesai <span class="text-danger">*</span></label>
                                    <input wire:model="end_date" type="date" class="form-control" name="end_date">
                                    @error('end_date')
                                    <span class="text-danger mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> <div class="col-lg-4">
                                </div>
                            <div class="col-lg-4">
                            <div class="form-group">
                                <label>Sales</label>
                                @include('utils.dropdown', ['id' => 'sales', 'hiddenInputName' => 'saler_id', 'options' => $salesOptions, 'placeholder' => 'Cari Sales', 'noResultsId' => 'noSalesResults'])
                            </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">                                                            
                                <div class="form-group">
                                    <label>Depo</label>
                                    @include('utils.dropdown', ['id' => 'depo', 'hiddenInputName' => 'depo_id', 'options' => $depotOptions, 'placeholder' => 'Cari Depo', 'noResultsId' => 'noDepoResults'])
                                </div>
                                </div>
                            </div>

                            <div class="col-lg-4">
                            <div class="form-group">
                                <label>Outlet</label>
                                @include('utils.dropdown', ['id' => 'outlet', 'hiddenInputName' => 'customer_id', 'options' => $customersOptions, 'placeholder' => 'Cari Outlet', 'noResultsId' => 'noOutletResults'])
                            </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select wire:model="sale_status" class="form-control" name="sale_status">
                                        <!-- <option value="">Pilih Status</option> -->
                                        <option value="Completed">Selesai</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Shipped">Diantar</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Status Pembayaran</label>
                                    <select wire:model="payment_status" class="form-control" name="payment_status">
                                        <!-- <option value="">Select Payment Status</option> -->
                                        <option value="Paid">Lunas</option>
                                        <option value="Unpaid">Belum Lunas</option>
                                        <option value="Partial">Sebagian</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                <label for="pagination">Tampil Data</label>
                                <input type="number" wire:model="pagination" id="pagination" class="form-control"value="10"min="1">
                               </div>

                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                            <!-- spinner-border spinner-border-sm -->
                                <span wire:target="generateReport" wire:loading class="" role="status" aria-hidden="true"></span>
                                <i wire:target="generateReport" wire:loading.remove class="bi bi-shuffle"></i>
                                Filter Report
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <span class="sr-only">Loading...</span>
                <div class="card-body">
                    <table class="table table-bordered table-striped text-center mb-0"id="salesTable">
                        <div wire:loading.flex class="col-12 position-absolute justify-content-center align-items-center" style="top:0;right:0;left:0;bottom:0;background-color: rgba(255,255,255,0.5);z-index: 99;">
                            <div class="spinner-border text-primary" role="status">
                            </div>
                        </div>
                        <div class="mt-2 mb-3 text-center">
                        <div class="mt-2 mb-3 text-center">
                            <a onclick="exportToPDF()" class="btn btn-md btn-primary mfs-auto mfe-1 d-print-none" style="background-color: #FF3131; color: #ffffff;">
                                <i class="bi bi-printer" style="color: #ffffff; font-size: 1.2em;"></i> Export  PDF
                            </a>

                            <a onclick="exportToXLSX()" class="btn btn-md btn-success mfs-auto mfe-1 d-print-none" style="background-color: #28a745; color: #ffffff;">
                                <i class="bi bi-printer" style="color: #ffffff; font-size: 1.2em;"></i> Export  XLSX
                            </a>
                            <a class="btn btn-md btn-success mfs-auto mfe-1 d-print-none" style="background-color: #6495ED; color: #ffffff;"href="{{ route('sales-report.index') }}">
                            <i class="bi bi-x-circle" style="color: #ffffff; font-size: 1.2em;"></i> Reset
                            </a>
                        </div>

                        </div>



                        <thead>
        <tr>
            <th>Tanggal</th>
            <th>No Faktur</th>
            <th>Depo</th>
            <th>Sales</th>
            <th>Outlet</th>
            <th>Total</th>
            <th>Pajak</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalAmount = 0;
            $totalTax = 0;
        @endphp

        @forelse($sales as $sale)
            <tr>
                <td>{{ \Carbon\Carbon::parse($sale->date)->format('d M, Y') }}</td>
                <td>{{ $sale->reference }}</td>
                <td>{{ $sale->kode_depo }}</td>
                <td>{{ $sale->kode_salesman }}</td>
                <td>{{ $sale->customer_name }}</td>
                <td>Rp {{ number_format($sale->total_amount / 10, 3) }}</td>
                <td>Rp {{ number_format($sale->tax_amount / 10, 3) }}</td>
                <td>
                    <span class="badge">
                        <a href="{{ route('sales.show', $sale->id) }}">
                            <img src="https://icons.veryicon.com/png/o/miscellaneous/simple-line-icon/view-details-4.png" alt="" style="max-width: 100%; height: 50px;">
                        </a>
                    </span>
                </td>
            </tr>

            @php
                $totalAmount += $sale->total_amount;
                $totalTax += $sale->tax_amount;
            @endphp

        @empty
            <tr>
                <td colspan="8">
                    <span class="text-danger">Tidak Data Penjualan</span>
                </td>
            </tr>
        @endforelse

        <tr>
            <td colspan="5" style="text-align: right; font-weight: bold;">Total Keseluruhan</td>
            <td style="font-weight: bold;">Rp {{ number_format($totalAmount / 10, 3) }}</td>
            <td style="font-weight: bold;">Rp {{ number_format($totalTax / 10, 3) }}</td>
            <td></td>
        </tr>
    </tbody>
</table>

                    <div @class(['mt-3' => $sales->hasPages()])>
                   
                    {{ $sales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><script>
    document.addEventListener('DOMContentLoaded', function () {
        var dropdownConfigurations = [
            {
                searchInputId: 'salesSearch',
                hiddenInputName: 'saler_id',
                dropdownSelector: '.sales-dropdown',
                noResultsId: 'noSalesResults',
            },
            {
                searchInputId: 'depoSearch',
                hiddenInputName: 'depo_id',
                dropdownSelector: '.depo-dropdown',
                noResultsId: 'noDepoResults',
            },
            {
                searchInputId: 'outletSearch',
                hiddenInputName: 'customer_id',
                dropdownSelector: '.outlet-dropdown',
                noResultsId: 'noOutletResults',
            },
        ];

        dropdownConfigurations.forEach(function (config) {
            initializeDropdown(config);
        });

        function initializeDropdown(config) {
            var searchInput = document.getElementById(config.searchInputId);
            var hiddenInput = document.querySelector('input[name="' + config.hiddenInputName + '"]');
            var dropdownItems = document.querySelectorAll(config.dropdownSelector + ' .dropdown-item');
            var noResultsMessage = document.getElementById(config.noResultsId);

            dropdownItems.forEach(function (item) {
                item.addEventListener('click', function (event) {
                    event.preventDefault();
                    searchInput.value = item.innerHTML.trim();
                    hiddenInput.value = item.getAttribute('data-value');
                    hiddenInput.dispatchEvent(new Event('input'));
// ger Livewire update
                });
            });

            searchInput.addEventListener('input', function () {
                var searchValue = this.value.toLowerCase();
                updateDropdownOptions(searchValue, dropdownItems, noResultsMessage);
            });
        }

        function updateDropdownOptions(searchValue, items, noResultsMessage) {
            var resultsFound = false;

            if (searchValue === '') {
                items.forEach(function (item) {
                    item.style.display = 'block';
                });
                noResultsMessage.style.display = 'none';
                return;
            }

            items.forEach(function (item) {
                var optionText = item.textContent.toLowerCase();

                if (optionText.includes(searchValue)) {
                    item.style.display = 'block';
                    resultsFound = true;
                } else {
                    item.style.display = 'none';
                }
            });

            noResultsMessage.style.display = resultsFound ? 'none' : 'block';
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

<script>
     function exportToPDF() {
        const tableData = [];
        const headers = [];
        let totalAmount = 0;
        let totalTax = 0;

        // Extract headers
        $('thead th:not(:last-child)').each(function () {
            headers.push({ text: $(this).text(), style: 'tableHeader' });
        });

        // Extract table data
        $('#salesTable tbody tr').each(function (index, row) {
            const rowData = [];

            // Skip rows with colspan (e.g., summary rows)
            if ($(row).find('td[colspan]').length > 0) {
                return;
            }

            $(row).find('td:not(:last-child)').each(function () {
                rowData.push($(this).text());
            });

            // Ensure rowData has enough elements
            if (rowData.length === headers.length) {
                // Ensure the values are not undefined or null before accessing properties
                const amountValue = rowData[5] ? rowData[5].replace('Rp', '').replace(',', '') : '0';
                const taxValue = rowData[6] ? rowData[6].replace('Rp', '').replace(',', '') : '0';

                totalAmount += parseFloat(amountValue);
                totalTax += parseFloat(taxValue);
            } else {
                console.error(`Malformed row at index ${index}:`, rowData);
                console.log('Complete row data:', row.innerHTML); // Log the HTML content of the problematic row
            }

            tableData.push(rowData);
        });

        // Add total row
        tableData.push(['', '', '', '', 'Total Keseluruhan', 'Rp ' + totalAmount.toFixed(3), 'Rp ' + totalTax.toFixed(3)]);

        // Define the document definition
        const docDefinition = {
            pageSize: 'A3', // Use A3 size paper
            pageMargins: [40, 30, 40, 30], // Adjust left, top, right, and bottom margins
            content: [
                { text: 'Laporan Penjualan', style: 'header', alignment: 'center', margin: [0, 0, 0, 10] },
                {
                    table: {
                        headerRows: 1,
                        widths: 'auto',
                        body: [headers, ...tableData],
                    },
                    layout: {
                        hLineColor: function (i, node) {
                            return i === 0 || i === node.table.body.length ? '#000000' : '#000000'; // Black horizontal lines
                        },
                        hLineWidth: function (i, node) {
                            return i === 0 || i === node.table.body.length ? 2 : 1; // Adjust line width
                        },
                    },
                },
            ],
            styles: {
                header: { fontSize: 18, bold: true, margin: [0, 0, 0, 10] },
                tableHeader: { fontSize: 12, bold: true, fillColor: '#007bff', color: '#ffffff', alignment: 'center', margin: [0, 3, 0, 3] },
            },
        };

        // Create the PDF
        pdfMake.createPdf(docDefinition).download('sales_data.pdf');
    }
    // Function to export to XLSX
    function exportToXLSX() {
        var table = document.getElementById('salesTable');
        var ws = XLSX.utils.table_to_sheet(table);
        var wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'Sales Data');
        XLSX.writeFile(wb, 'sales_report.xlsx');
    }
</script>
