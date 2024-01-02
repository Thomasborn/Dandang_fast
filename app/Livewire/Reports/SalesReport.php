<?php

namespace App\Livewire\Reports;

use App\Exports\SalesExport;
use App\Models\Depo;
use App\Models\Sales;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\People\Entities\Customer;
use Modules\Sale\Entities\Sale;

class SalesReport extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $customers;
    public $start_date;
    public $end_date;
    public $customer_id;
    public $sale_status;
    public $payment_status;
    public $depo_id; // New property for Depo filter
    public $saler_id; // New property for Sales filter
    public $depotOptions; // Add property for Depo options
    public $salesOptions; // Add property for Sales options
    public $customersOptions; // Add property for Sales options
    public $pagination; // Add property for Sales options
// Livewire component

protected $listeners = ['salerIdUpdated' => 'updateSalerId'];

public function updateSalerId($value)
{
    $this->saler_id = $value;
}

    protected $rules = [
        'start_date' => 'required|date|before:end_date',
        'end_date'   => 'required|date|after:start_date',
    ];

    public function mount($customers) {
        $this->customers = $customers;
        $this->start_date = today()->subDays(300)->format('Y-m-d');
        $this->end_date = today()->format('Y-m-d');
        $this->customer_id = '';
        $this->sale_status = '';
        $this->payment_status = '';
        $this->depo_id = ''; // Initialize Depo filter
        $this->saler_id = ''; 
        $this->pagination = 10; 
        $this->depotOptions = Depo::pluck('Kode', 'Kode')->all(); // Assuming 'Kode' is the display column and 'id' is the value column
        $this->customersOptions = Customer::pluck('customer_name', 'id')->all(); // Assuming 'Kode' is the display column and 'id' is the value column
    $this->salesOptions = Sales::pluck('Nama', 'Kode')->all(); // 
    }

    public function exportPDF()
    {
        $sales = utf8_decode($this->getFilteredSales());

        // dd($sales);
// Check and convert encoding if needed
// $sales = mb_convert_encoding($sales, 'UTF-8', 'auto');

$pdf = Pdf::loadView('livewire.reports.sales-report-pdf', ['sales' => $sales]);

return $pdf->download('sales-report.pdf');

    }

    public function exportXLSX()
    {
        $this->validate();

        $sales = $this->getFilteredSales();
        return Excel::download(new SalesExport($sales), 'sales-report.xlsx');
    }

    protected function getFilteredSales()
    {
        return Sale::whereDate('date', '>=', $this->start_date)
            ->whereDate('date', '<=', $this->end_date)
            ->when($this->customer_id, function ($query) {
                return $query->where('customer_id', $this->customer_id);
            })
            ->when($this->depo_id, function ($query) {
                return $query->where('kode_depo', $this->depo_id);
            })
            ->when($this->saler_id, function ($query) {
                return $query->where('kode_salesman', $this->saler_id);
            })
            ->when($this->sale_status, function ($query) {
                return $query->where('status', $this->sale_status);
            })
            ->when($this->payment_status, function ($query) {
                return $query->where('payment_status', $this->payment_status);
            })
            ->orderBy('date', 'desc')->paginate($this->pagination);
            // ->get();
    }

    public function render()
    {
        $sales = $this->getFilteredSales();

        return view('livewire.reports.sales-report', [
            'sales' => $sales
        ]);
    }

    public function generateReport() {
        $this->validate();
        $this->render();
    }
}
