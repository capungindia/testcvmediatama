<?php

namespace App\DataTables;

use App\Models\Videos;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class VideosDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'videos.datatables_actions')
            ->editColumn('filename', 'videos.datatables_filename')
            ->rawColumns(['action', 'filename']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Videos $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Videos $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '4em', 'printable' => false])
            ->parameters([
                'dom'       => 'B<"clearfix">frti<"clearfix">',
                'paging'    => false,
                'scrollY'   => '50vh',
                'scrollCollapse' => true,
                'scrollX'   => true,
                'responsive' => true,
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [
            'title',
            'description'
        ];

        if(auth()->user()->role == 'admin'){
            array_push($columns, 'filename');
        }

        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'videos_datatable_' . time();
    }
}
