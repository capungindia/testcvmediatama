<?php

namespace App\Http\Controllers;

use App\DataTables\VideosDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateVideosRequest;
use App\Http\Requests\UpdateVideosRequest;
use App\Repositories\VideosRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class VideosController extends AppBaseController
{
    /** @var  VideosRepository */
    private $videosRepository;

    public function __construct(VideosRepository $videosRepo)
    {
        $this->videosRepository = $videosRepo;
        $this->middleware('auth');
        $this->middleware('authorize');
        $this->middleware('notification');
    }

    /**
     * Display a listing of the Videos.
     *
     * @param VideosDataTable $videosDataTable
     * @return Response
     */
    public function index(VideosDataTable $videosDataTable)
    {
        return $videosDataTable->render('videos.index');
    }

    /**
     * Show the form for creating a new Videos.
     *
     * @return Response
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created Videos in storage.
     *
     * @param CreateVideosRequest $request
     *
     * @return Response
     */
    public function store(CreateVideosRequest $request)
    {
        $input = $request->all();
        
        $uploadedFile = $request->file('filename');

        $uploadedFileOriginalExtension = $uploadedFile->getClientOriginalExtension();
        $filename = now()->format('Ymdhis').'.'.$uploadedFileOriginalExtension;
        $input['filename'] = $filename;

        \Storage::disk('public')->putFileAs(
            'videos/',
            $uploadedFile,
            $filename
        );

        $videos = $this->videosRepository->create($input);

        Flash::success('Videos saved successfully.');

        return redirect(route('videos.index'));
    }

    /**
     * Display the specified Videos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $videos = $this->videosRepository->find($id);

        if (empty($videos)) {
            Flash::error('Videos not found');

            return redirect(route('videos.index'));
        }

        if(auth()->user()->role == 'customer'){
            $videoRequests = \App\Models\VideoRequests::leftJoin('notifications', 'video_requests.id', '=', 'notifications.reference_id')
                ->orderBy('video_requests.verified_at', 'desc')
                ->where('video_requests.user_id', auth()->user()->id)
                ->where('video_requests.video_id', $id)
                ->whereNotNull('notifications.read_at')
                ->whereNotNull('video_requests.verified_at')
                ->select(['video_requests.*', 'notifications.read_at'])
                ->first();
            
            if(!is_null($videoRequests)){
                $videoAccessExpiredAt = \Carbon\Carbon::parse($videoRequests->read_at)->addMinutes($videoRequests->allowed_duration);
                if(now() < $videoAccessExpiredAt){
                    \Session::flash('hasAccess', true);
                    \Session::flash('message', 'You have an access to this video until about '.$videoAccessExpiredAt->format('Y-m-d h:i:s'));
                } else {
                    Flash::warning('Your access for this video has been expired');
                    \Session::flash('hasAccess', false);
                }
            }
        }

        return view('videos.show')->with('videos', $videos);
    }

    /**
     * Show the form for editing the specified Videos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $videos = $this->videosRepository->find($id);

        if (empty($videos)) {
            Flash::error('Videos not found');

            return redirect(route('videos.index'));
        }

        return view('videos.edit')->with('videos', $videos);
    }

    /**
     * Update the specified Videos in storage.
     *
     * @param  int              $id
     * @param UpdateVideosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVideosRequest $request)
    {
        $videos = $this->videosRepository->find($id);

        if (empty($videos)) {
            Flash::error('Videos not found');

            return redirect(route('videos.index'));
        }

        $videos = $this->videosRepository->update($request->all(), $id);

        Flash::success('Videos updated successfully.');

        return redirect(route('videos.index'));
    }

    /**
     * Remove the specified Videos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $videos = $this->videosRepository->find($id);

        if (empty($videos)) {
            Flash::error('Videos not found');

            return redirect(route('videos.index'));
        }

        \Storage::disk('public')->delete(
            'videos/'.$videos->filename
        );

        $this->videosRepository->delete($id);

        Flash::success('Videos deleted successfully.');

        return redirect(route('videos.index'));
    }
}
