<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

use App\Models\Sale;
use Modules\Sale\Entities\Sale as EntitiesSale;

class SalesExport implements FromCollection
{
    public function collection()
    {
        // Fetch your sales data here
        return EntitiesSale::all();
    }
}
