<?php

namespace App\Livewire;
// app/Http/Livewire/DepoList.php

// app/Http/Livewire/DepoList.php
// app/Http/Livewire/DepoList.php


use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Depo;

class DepoList extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 2;

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // dd($this->search);

        $depos = Depo::where('Kode', 'like', '%' . $this->search . '%')
            ->orWhere('alamat', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.depo-list', compact('depos'));
    }
}
