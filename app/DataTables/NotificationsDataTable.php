<?php

namespace App\DataTables;

use App\Models\Notifications;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class NotificationsDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'notifications.datatables_actions')
            ->rawColumns(['message', 'action'])
            ->editColumn('created_at', function($notifications){
                return $notifications->created_at->format('Y-m-d h:i:s');
            })
            ->editColumn('read_at', function($notifications){
                return is_null($notifications->read_at) ? 'Not read yet' : $notifications->read_at->format('Y-m-d h:i:s');
            })
            ->filterColumn('read_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(read_at,'%Y-%m-%d %h:%i:%s') like ?", ["%$keyword%"]);
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%Y-%m-%d %h:%i:%s') like ?", ["%$keyword%"]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Notifications $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Notifications $model)
    {
        return $model->newQuery()
            ->where('user_id', auth()->user()->id);
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
        return [
            [
                'name'          => 'created_at',
                'data'          => 'created_at',
                'title'         => 'Notification Date',
            ],
            'message',
            'read_at',
        ];
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
