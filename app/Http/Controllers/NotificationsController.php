<?php

namespace App\Http\Controllers;

use App\DataTables\NotificationsDataTable;
use App\Repositories\NotificationsRepository;
use App\Repositories\VideoRequestsRepository;
use Illuminate\Http\Request;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class NotificationsController extends AppBaseController
{
    /** @var  NotificationsRepository */
    private $notificationsRepository;

    /** @var  VideoRequestsRepository */
    private $videoRequestsRepository;
    

    public function __construct(NotificationsRepository $notificationsRepo, VideoRequestsRepository $videoRequestsRepo)
    {
        $this->notificationsRepository = $notificationsRepo;
        $this->videoRequestsRepository = $videoRequestsRepo;
        $this->middleware('auth');
        $this->middleware('authorize');
        $this->middleware('notification');
    }

    /**
     * Display a listing of the Notifications.
     *
     * @param NotificationsDataTable $notificationsDataTable
     * @return Response
     */
    public function index(NotificationsDataTable $notificationsDataTable)
    {
        return $notificationsDataTable->render('notifications.index');
    }
    
    /**
     * Display the specified Users.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notifications = $this->notificationsRepository->find($id);
        if(is_null($notifications->read_at) && $notifications->user_id == auth()->user()->id){
            if($notifications->reference_type == 'videoRequests'){
                $videoRequest = $this->videoRequestsRepository->find($notifications->reference_id);
                
                $notifications->read_at = now();
                $notifications->message .= ' (until about '.$notifications->read_at->addMinutes($videoRequest->allowed_duration)->format('Y-m-d H:i:s').')';
                $notifications->save();
            }
        }

        if (empty($notifications)) {
            Flash::error('Notifications not found');

            return redirect(route('notifications.index'));
        }

        return view('notifications.show')->with('notifications', $notifications);
    }
}
