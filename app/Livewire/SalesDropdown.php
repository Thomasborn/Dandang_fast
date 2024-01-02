<?php

namespace App\Livewire;



use Livewire\Component;
use App\Models\Sales;

class SalesDropdown extends Component
{
    public $query = '';
    public $salesOptions;

    public function render()
    {
        $this->salesOptions = Sales::where('Nama', 'like', '%' . $this->query . '%')
            ->orWhere('Kode', 'like', '%' . $this->query . '%')
            ->take(5)
            ->get();

        return view('livewire.sales-dropdown');
    }
}
