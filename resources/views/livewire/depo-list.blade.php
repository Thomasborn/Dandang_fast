
<div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="Search...">
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="depoTable">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Kode</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($depos as $depo)
                        <tr>
                            <td>{{ $depo->Kzode }}</td>
                            <td>{{ $depo->alamat }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm">Edit</button>
                                <button class="btn btn-info btn-sm">Detail</button>
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end">
            {{ $depos->links() }}
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#depoTable').DataTable({
                lengthChange: false,
                searching: false,
                info: false,
                pagingType: 'simple',
            });

            // Live Search
            $('#search').on('keyup', function() {
                $('#depoTable').DataTable().search($(this).val()).draw();
            });
        });
    </script>