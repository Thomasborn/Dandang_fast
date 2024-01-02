@can('edit_expenses')
<a href="{{ route('depo.edit', $data->Kode) }}" class="btn btn-info btn-sm">
    <i class="bi bi-pencil"></i>
</a>
@endcan
@can('delete_expenses')
<button id="delete" class="btn btn-danger btn-sm" onclick="
    event.preventDefault();
    if (confirm('Are you sure? It will delete the data permanently!')) {
    document.getElementById('destroy{{ $data->Kode }}').submit();
    }
    ">
    <i class="bi bi-trash"></i>
    <form id="destroy{{ $data->Kode }}" class="d-none" action="{{ route('depo.destroy', $data->Kode) }}" method="POST">
        @csrf
        @method('delete')
    </form>
</button>
@endcan
