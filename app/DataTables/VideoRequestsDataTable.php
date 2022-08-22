<?php

namespace App\DataTables;

use App\Models\VideoRequests;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

use DB;

class VideoRequestsDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'video_requests.datatables_actions')
            ->editColumn('verified_at', function($videoRequest){
                return is_null($videoRequest->verified_at) ? 'Not verified yet' : $videoRequest->verified_at->format('Y-m-d h:i:s');
            })
            ->editColumn('verifier_name', function($videoRequest){
                return is_null($videoRequest->verified_at) ? 'Not verified yet' : $videoRequest->verifier_name;
            })
            ->editColumn('created_at', function($videoRequest){
                return $videoRequest->created_at->format('Y-m-d h:i:s');
            })
            ->filterColumn('verified_at', function ($query, $keyword) {
                $query->whereRaw("IFNULL(DATE_FORMAT(verified_at,'%Y-%m-%d'), 'Not verified yet') like ?", ["%$keyword%"]);
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(video_requests.created_at,'%Y-%m-%d %h:%i:%s') like ?", ["%$keyword%"]);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\VideoRequests $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(VideoRequests $model)
    {
        $query = $model->newQuery()
            ->join('videos', 'videos.id', '=', 'video_requests.video_id')
            ->leftJoin(DB::raw('users as verifier'), 'verifier.id', '=', 'video_requests.verifier_id')
            ->select('video_requests.*', 'videos.title', DB::raw('verifier.name as verifier_name'));

        if(auth()->user()->role == 'customer')
            $query = $query->where('video_requests.user_id', auth()->user()->id);
            
        return $query;
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
                    // ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
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
            [
                'name'          => 'created_at',
                'data'          => 'created_at',
                'title'         => 'Request Date',
            ],
            [
                'name'          => 'videos.title',
                'data'          => 'title',
                'title'         => 'Requested Video',
            ],
            'verified_at',
            [
                'name'          => 'verifier.name',
                'data'          => 'verifier_name',
                'title'         => 'Verifier',
            ],
            [
                'name'          => 'allowed_duration',
                'data'          => 'allowed_duration',
                'title'         => 'Allowed Duration (Mins)',
            ],
        ];

        if(auth()->user()->role == 'admin')
            array_push($columns, [
                'name'          => 'created_by',
                'data'          => 'created_by',
                'title'         => 'Requested By',
            ]);

        return $columns; 
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'video_requests_datatable_' . time();
    }
}
