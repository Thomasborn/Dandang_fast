<?php

namespace Modules\Sale\DataTables;

use Modules\Sale\Entities\Sale;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SalesDataTable extends DataTable
{

    public function dataTable($query) {
        return datatables()
            ->eloquent($query)
            ->addColumn('total_amount', function ($data) {
                return 'Rp ' . number_format($data->total_amount / 10, 3, '.', ',');

            })
            ->addColumn('paid_amount', function ($data) {
                return ($data->kode_salesman);
            })
            ->addColumn('due_amount', function ($data) {
                return ($data->kode_depo);
            })
            ->addColumn('status', function ($data) {
                return view('sale::partials.status', compact('data'));
            })
            ->addColumn('payment_status', function ($data) {
                return view('sale::partials.payment-status', compact('data'));
            })
            ->addColumn('action', function ($data) {
                return view('sale::partials.actions', compact('data'));
            });
    }

    public function query(Sale $model) {
        return $model->newQuery();
    }

    public function html() {
        return $this->builder()
            ->setTableId('sales-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                'tr' .
                                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(8)
            ->buttons(
                Button::make('excel')
                ->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel')
                ->className('btn btn-success'),
     
            Button::make('print')
                ->text('<i class="bi bi-file-pdf-fill"></i> PDF')
                ->className('btn btn-danger'),
            Button::make('reset')
                ->text('<i class="bi bi-x-circle"></i> Reset')
                ->className('btn btn-warning'),
            Button::make('reload')
                ->text('<i class="bi bi-arrow-repeat"></i> Reload')
                ->className('btn btn-info')
        )
        ->parameters([
            'initComplete' => 'function(settings, json) {
                $(this).find("thead").addClass("thead-dark");
            }',
        ]);    }

    protected function getColumns() {
        return [
            Column::make('reference')
            ->title('No Faktur')
                ->className('text-center align-middle'),

            Column::make('customer_name')
                ->title('Outlet')
                ->className('text-center align-middle'),

            Column::computed('status')
                ->className('text-center align-middle'),

            Column::computed('total_amount')
            ->title('Total Harga')
                ->className('text-center align-middle'),

            Column::computed('paid_amount')
            ->title('Sales')
                ->className('text-center align-middle'),

            Column::computed('due_amount')
            ->title('Depo')
                ->className('text-center align-middle'),

            Column::computed('payment_status')->title('Status Pembayaran')
                ->className('text-center align-middle'),

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false)
        ];
    }

    protected function filename(): string {
        return 'Sales_' . date('YmdHis');
    }
}
