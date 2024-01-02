<?php

namespace Modules\People\DataTables;

use Illuminate\Support\Str;
use Modules\People\Entities\Customer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CustomersDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('people::customers.partials.actions', compact('data'));
            });
    }

    public function query(Customer $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('customers-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                                       'tr' .
                                 <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(4)
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
            ]);
    }

    protected function getColumns()
    {
        return [
            Column::make('customer_name')
                ->title('Outlet')
                ->className('text-center align-middle'),

            Column::make('address')
                ->title('Alamat')
                ->className('text-center align-middle'),

            Column::make('city')
                ->title('Kabupaten')
                ->className('text-center align-middle'),

            Column::computed('action')
                ->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle'),

            Column::make('created_at')
                ->visible(false),
        ];
    }

    protected function filename(): string
    {
        return 'Customers_' . date('YmdHis');
    }
}
