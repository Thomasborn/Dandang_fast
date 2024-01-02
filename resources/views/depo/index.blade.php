@extends('layouts.app')

@section('title', 'Depo List')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
        <li class="breadcrumb-item active">Depo</li>
    </ol>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="m-0">Daftar Depo</h2>
                        <div>
                            <a href="{{ route('depo.create') }}" class="btn btn-primary">
                                Tambah Depo <i class="bi bi-plus"></i>
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

                    <table class="table table-bordered" id="depoTable">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th class="align-middle">Kode</th>
                                <th class="align-middle">Alamat</th>
                                <!-- Add this line to include the "Aksi" column in the header -->
                                <th class="align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($depos as $depo)
                                <tr>
                                    <td>{{ $depo->Kode }}</td>
                                    <td>{{ $depo->alamat }}</td>
                                    <td class="text-center">
                                        @can('edit_depo')
                                            <a href="{{ route('depo.edit', $depo->Kode) }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endcan

                                        @can('show_depo')
                                            <a href="{{ route('depo.show', $depo->Kode) }}" class="btn btn-primary btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        @endcan

                                        @can('delete_depo')
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmationModal{{ $depo->Kode }}">
    <i class="bi bi-trash"></i>
</button>

<div class="modal fade" id="confirmationModal{{ $depo->Kode }}" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Yakin ingin menghapus data dengan Kode: <strong>{{ $depo->Kode }}</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="destroy{{ $depo->Kode }}" action="{{ route('depo.destroy', $depo->Kode) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
                                            <form id="destroy{{ $depo->Kode }}" class="d-none" action="{{ route('depo.destroy', $depo->Kode) }}" method="POST">
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



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
<<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#depoTable').DataTable({
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
                        columns: [0, 1,3]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [0, 1]
                    }
                },
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
                var wrapper = $('#depoTable_wrapper');
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
