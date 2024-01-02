@extends('layouts.app')

@section('title', 'Depo List')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('depo.create') }}" class="btn btn-primary">
                        Tambah Depo <i class="bi bi-plus"></i>
                    </a>
                    <hr>

                    <table class="table" id="depoTable">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($depos as $depo)
                                <tr>
                                    <td>{{ $depo->Kode }}</td>
                                    <td>{{ $depo->alamat }}</td>
                                    <td>
                                        @can('edit_depos')
                                            <a href="{{ route('depo.edit', $depo->Kode) }}" class="btn btn-info btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        @endcan

                                        @can('show_depos')
                                            <a href="{{ route('depo.show', $depo->Kode) }}" class="btn btn-primary btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        @endcan

                                        @can('delete_depos')
                                            <button id="delete" class="btn btn-danger btn-sm" onclick="
                                                event.preventDefault();
                                                if (confirm('Are you sure? It will delete the data permanently!')) {
                                                    document.getElementById('destroy{{ $depo->Kode }}').submit();
                                                }
                                            ">
                                                <i class="bi bi-trash"></i>
                                                <form id="destroy{{ $depo->Kode }}" class="d-none" action="{{ route('depo.destroy', $depo->Kode) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </button>
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
<script>
    $(document).ready(function() {
        $('#depoTable').DataTable({
            "pageLength": 10,
            "lengthMenu": [2, 5, 10, 25],
            "pagingType": "simple_numbers",
        });

        $('#search').on('keyup', function() {
            $('#depoTable').DataTable().search($(this).val()).draw();
        });
    });
</script>
@endsection
