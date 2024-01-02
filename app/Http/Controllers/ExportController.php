<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\DB;
use Modules\Sale\Entities\Sale as EntitiesSale;

class ExportController extends Controller
{
    public function exportPDF(Request $request)
    {
        $sales = $this->getFilteredSales($request);
        // dd($sales);
        return view('livewire.reports.sales-report-pdf',['sales' => $sales]);
    }

    public function exportXLSX(Request $request)
    {
        $sales = $this->getFilteredSales($request);

        return Excel::download(new SalesExport($sales), 'sales-report.xlsx');
    }

    protected function getFilteredSales(Request $request)
    {
        dd($request->start_date);
        // Convert date formats if needed
        $start_date = \Carbon\Carbon::parse($request->start_date)->format('Y-m-d');
        $end_date = \Carbon\Carbon::parse($request->end_date)->format('Y-m-d');

       return EntitiesSale::whereDate('date', '>=', $start_date)
            ->whereDate('date', '<=', $end_date)
            ->when($request->customer_id, function ($query) use ($request) {
                return $query->where('customer_id', $request->customer_id);
            })
            ->when($request->depo_id, function ($query) use ($request) {
                return $query->where('kode_depo', $request->depo_id);
            })
            ->when($request->saler_id, function ($query) use ($request) {
                return $query->where('kode_salesman', $request->saler_id);
            })
            ->when($request->sale_status, function ($query) use ($request) {
                return $query->where('status', $request->sale_status);
            })
            ->when($request->payment_status, function ($query) use ($request) {
                return $query->where('payment_status', $request->payment_status);
            })
            ->orderBy('date', 'desc')
            ->paginate(10);
// dd($sales);
            // return $sales;
    }
}
