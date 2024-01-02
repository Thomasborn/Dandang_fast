<!-- resources/views/livewire/sales-search-dropdown.blade.php -->

<div>
    <input wire:model.debounce.300ms="query" type="text" class="form-control" placeholder="Search Sales...">
    
    @if(!empty($salesOptions))
        <ul class="list-group mt-2">
            @foreach($salesOptions as $sales)
                <li class="list-group-item">{{ $sales->Nama }} | {{ $sales->Kode }}</li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-warning mt-2">No Sales found.</div>
    @endif
</div>
