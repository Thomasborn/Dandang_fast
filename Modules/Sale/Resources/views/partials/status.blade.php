@if ($data->status == 'Pending')
    <span class="badge badge-info">
        <!-- {{ $data->status }} -->
   Pending
 </span>
@elseif ($data->status == 'Shipped')
    <span class="badge badge-primary">
        <!-- {{ $data->status }} -->
        Diantar
    </span>
@elseif ($data->status == 'completed')
    <span class="badge badge-success">
        <!-- {{ $data->status }} -->
        Selesai
    </span>
@else
    <span class="badge badge-success">
        {{ $data->status }}
    </span>
@endif
