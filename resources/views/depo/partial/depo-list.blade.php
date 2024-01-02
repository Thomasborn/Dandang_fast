<div>
  <!-- resources/views/depo/partial/depo-list.blade.php -->

@foreach ($depos as $depo)
    <tr>
        <td>{{ $depo->Kode }}</td>
        <td>{{ $depo->alamat }}</td>
        <td>
            <button class="btn btn-primary">Edit</button>
            <button class="btn btn-info">Detail</button>
            <button class="btn btn-danger">Hapus</button>
        </td>
    </tr>
@endforeach
  <!-- Live as if you were to die tomorrow. Learn as if you were to live forever. - Mahatma Gandhi -->
</div>
