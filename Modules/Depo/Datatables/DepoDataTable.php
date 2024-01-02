<?php

namespace Modules\Depo\DataTables;

use App\Models\Depo as ModelsDepo;
use Modules\Depo\Entities\Depo;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DepoDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                return view('depo::partials.actions', compact('data'));
            })
            ->rawColumns(['action']); // Specify 'action' as a raw HTML column
    }

    public function query(ModelsDepo $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('depo-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-md-3'l><'col-md-5 mb-2'B><'col-md-4'f>> .
                'tr' .
                <'row'<'col-md-5'i><'col-md-7 mt-2'p>>")
            ->orderBy(0) // Assuming 'id' is the first column, adjust accordingly
            ->buttons(
                Button::make('excel')->text('<i class="bi bi-file-earmark-excel-fill"></i> Excel'),
                Button::make('print')->text('<i class="bi bi-printer-fill"></i> Print'),
                Button::make('reset')->text('<i class="bi bi-x-circle"></i> Reset'),
                Button::make('reload')->text('<i class="bi bi-arrow-repeat"></i> Reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::make('Kode')->title('Kode')->className('text-center align-middle'),
            // Add other columns from the 'Depo' model as needed...

            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->className('text-center align-middle')
        ];
    }

    protected function filename(): string
    {
        return 'Depos_' . date('YmdHis');
    }
}
