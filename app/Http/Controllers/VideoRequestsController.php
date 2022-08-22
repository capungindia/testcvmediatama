<?php

namespace App\Http\Controllers;

use App\DataTables\VideoRequestsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateVideoRequestsRequest;
use App\Http\Requests\UpdateVideoRequestsRequest;
use App\Repositories\VideoRequestsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class VideoRequestsController extends AppBaseController
{
    /** @var  VideoRequestsRepository */
    private $videoRequestsRepository;

    public function __construct(VideoRequestsRepository $videoRequestsRepo)
    {
        $this->videoRequestsRepository = $videoRequestsRepo;
        $this->middleware('auth');
        $this->middleware('authorize');
        $this->middleware('notification');
    }

    /**
     * Display a listing of the VideoRequests.
     *
     * @param VideoRequestsDataTable $videoRequestsDataTable
     * @return Response
     */
    public function index(VideoRequestsDataTable $videoRequestsDataTable)
    {
        return $videoRequestsDataTable->render('video_requests.index');
    }

    /**
     * Show the form for creating a new VideoRequests.
     *
     * @return Response
     */
    public function create()
    {
        return view('video_requests.create');
    }

    /**
     * Store a newly created VideoRequests in storage.
     *
     * @param CreateVideoRequestsRequest $request
     *
     * @return Response
     */
    public function store(CreateVideoRequestsRequest $request)
    {
        $redirectRoute = 'videoRequests.index';
        $redirectUrl = route($redirectRoute);
        if($redirectUrl !== url()->previous());
            $redirectUrl = url()->previous();

        $input = $request->all();

        $videoRequests = $this->videoRequestsRepository->create($input);

        Flash::success('Video Requests saved successfully. <br/> Click <a href="'.route($redirectRoute).'">here</a> to see your request status');

        return redirect(url()->previous());
    }

    /**
     * Display the specified VideoRequests.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $videoRequests = $this->videoRequestsRepository->find($id);

        if (empty($videoRequests)) {
            Flash::error('Video Requests not found');

            return redirect(route('videoRequests.index'));
        }

        return view('video_requests.show')->with('videoRequests', $videoRequests);
    }

    /**
     * Show the form for editing the specified VideoRequests.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $videoRequests = $this->videoRequestsRepository->find($id);

        if (empty($videoRequests)) {
            Flash::error('Video Requests not found');

            return redirect(route('videoRequests.index'));
        }

        return view('video_requests.edit')->with('videoRequests', $videoRequests);
    }

    /**
     * Update the specified VideoRequests in storage.
     *
     * @param  int              $id
     * @param UpdateVideoRequestsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVideoRequestsRequest $request)
    {
        $videoRequests = $this->videoRequestsRepository->find($id);

        if (empty($videoRequests)) {
            Flash::error('Video Requests not found');

            return redirect(route('videoRequests.index'));
        }

        $redirectUrl = route('videoRequests.index');

        try{
            $updates = $request->all();
            $updates['verified_at'] = now();

            $videoRequests = $this->videoRequestsRepository->update($updates, $id);

            $notifications = [];
            $notifications["user_id"] = $videoRequests->user_id;
            $notifications["reference_type"] = 'videoRequests';
            $notifications["reference_id"] = $videoRequests->id;
            $notifications["message"] = 'Your request for video <a href='.route('videos.show', $videoRequests->video_id).'>'.$videoRequests->video->title.'</a> has beed verified by '.auth()->user()->name.'. Now you can access the video for about '.$videoRequests->allowed_duration.' minutes';
            app('App\Http\Controllers\API\NotificationsAPIController')->store(new \App\Http\Requests\API\CreateNotificationsAPIRequest($notifications));

            Flash::success('Video Requests updated successfully.');
        } catch(\Exception $e){
            Flash::error($e->getMessage());

            $redirectUrl = route('videoRequests.edit', $id);
        }
        
        return redirect($redirectUrl)
            ->withInput();
    }

    /**
     * Remove the specified VideoRequests from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $videoRequests = $this->videoRequestsRepository->find($id);

        if (empty($videoRequests)) {
            Flash::error('Video Requests not found');

            return redirect(route('videoRequests.index'));
        }

        $this->videoRequestsRepository->delete($id);

        Flash::success('Video Requests deleted successfully.');

        return redirect(route('videoRequests.index'));
    }
}
