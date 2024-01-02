@extends('layouts.app')

@section('title', 'Saler List')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active">Saler</li>
    </ol>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="m-0">Daftar Saler</h2>
                        <div>
                            <a href="{{ route('saler.create') }}" class="btn btn-primary">
                                Tambah Saler <i class="bi bi-plus"></i>
                            </a>
                            <div class="btn-group">
                                <button class="btn btn-success" id="exportExcel">
                                    <i class="bi bi-file-earmark-excel-fill"></i> Excel
                                </button>
                                <button class="btn btn-danger" id="exportPdf">
                                    <i class="bi bi-file-pdf-fill"></i> PDF
                                </button>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered" id="salerTable">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th class="align-middle">Kode</th>
                                <th class="align-middle">Nama</th>
                                <th class="align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salers as $saler)
                                <tr>
                                    <td>{{ $saler->Kode }}</td>
                                    <td>{{ $saler->Nama }}</td>
                                    <td class="text-center">
                                        @can('edit_saler')
                                            <a href="{{ route('saler.edit', $saler->Kode) }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endcan

                                        @can('show_saler')
                                            <a href="{{ route('saler.show', $saler->Kode) }}" class="btn btn-primary btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        @endcan

                                        @can('delete_saler')
                                           <!-- Button to trigger the modal -->
<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmationModal{{ $saler->Kode }}">
    <i class="bi bi-trash"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="confirmationModal{{ $saler->Kode }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Yakin ingin menghapus data dengan Kode: <strong>{{ $saler->Kode }}</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="destroy{{ $saler->Kode }}" action="{{ route('saler.destroy', $saler->Kode) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

                                            <form id="destroy{{ $saler->Kode }}" class="d-none" action="{{ route('saler.destroy', $saler->Kode) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.5/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.5/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.11.5/api/sum().js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.11.5/sorting/num-html.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#salerTable').DataTable({
            "pageLength": 10,
            "lengthMenu": [2, 5, 10, 25],
            "pagingType": "simple_numbers",
            "buttons": [
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1],
                        customize: function(doc) {
                            doc.pageMargins = [40, 40, 40, 40];

            // Set content styling
            doc.defaultStyle.fontSize = 12;
            doc.styles['title'] = {
                fontSize: 18,
                bold: true,
                alignment: 'center',
                margin: [0, 0, 0, 20]
            };

            // Table styling
            doc.styles['table'] = {
                margin: [0, 5, 0, 15]
            };

            // Table header styling
            doc.styles['thead'] = {
                fontSize: 14,
                bold: true,
                color: 'black'
            };

            // Apply styles to existing elements
            doc.content[1].margin = [0, 0, 0, 0];
            doc.content[1].table.widths = ['*', '*', '*']; // Equal column widths

            // Apply alternating row background color
            var rowCount = 0;
            doc.content[1].table.body.forEach(function (row) {
                rowCount % 2 === 0 ? row.fillColor = '#f9f9f9' : row.fillColor = null;
                rowCount++;
            });
        }
    }
}

,
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2]
                    }
                }
            ],
            "columnDefs": [
                {
                    "className": "dt-center",
                    "targets": [0, 1, 2] // Index of columns (0-based) to be centered
                }
            ],
            "initComplete": function(settings, json) {
                // Center the table within its wrapper
                var wrapper = $('#salerTable_wrapper');
                wrapper.css({
                    'margin': 'auto',
                    'text-align': 'center'
                });
            }
        });

        // Live Search
        $('#search').on('keyup', function() {
            table.search($(this).val()).draw();
        });

        // Export to Excel
        $('#exportExcel').on('click', function() {
            table.button('.buttons-excel').trigger();
        });

        // Export to PDF
        $('#exportPdf').on('click', function() {
            table.button('.buttons-pdf').trigger();
        });
    });
</script>


@endsection
