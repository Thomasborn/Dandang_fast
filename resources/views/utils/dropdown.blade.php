<div class="dropdown {{ $id }}-dropdown">
    <input type="text" id="{{ $id }}Search" class="form-control" placeholder="{{ $placeholder }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <div class="dropdown-menu" aria-labelledby="{{ $id }}Search" style="max-height: 200px; overflow-y: auto;">
        @foreach($options as $kode => $display)
            <a class="dropdown-item" href="#" data-value="{{ $kode }}">{{ $display }} ({{ $kode }})</a>
        @endforeach
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#" data-value="" id="{{ $noResultsId }}" style="display: none;">Tidak ada hasil</a>
    </div>
    <input type="hidden" wire:model="{{ $hiddenInputName }}" name="{{ $hiddenInputName }}" value="">
</div>
