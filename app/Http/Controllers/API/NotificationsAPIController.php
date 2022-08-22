<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateNotificationsAPIRequest;
use App\Http\Requests\API\UpdateNotificationsAPIRequest;
use App\Models\Notifications;
use App\Repositories\NotificationsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class NotificationsController
 * @package App\Http\Controllers\API
 */

class NotificationsAPIController extends AppBaseController
{
    /** @var  NotificationsRepository */
    private $notificationsRepository;

    public function __construct(NotificationsRepository $notificationsRepo)
    {
        $this->notificationsRepository = $notificationsRepo;
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the Notifications.
     * GET|HEAD /notifications
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $notifications = $this->notificationsRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($notifications->toArray(), 'Notifications retrieved successfully');
    }

    /**
     * Store a newly created Notifications in storage.
     * POST /notifications
     *
     * @param CreateNotificationsAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateNotificationsAPIRequest $request)
    {
        $input = $request->all();

        $notifications = $this->notificationsRepository->create($input);

        return $this->sendResponse($notifications->toArray(), 'Notifications saved successfully');
    }

    /**
     * Display the specified Notifications.
     * GET|HEAD /notifications/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Notifications $notifications */
        $notifications = $this->notificationsRepository->find($id);

        if (empty($notifications)) {
            return $this->sendError('Notifications not found');
        }

        return $this->sendResponse($notifications->toArray(), 'Notifications retrieved successfully');
    }

    /**
     * Update the specified Notifications in storage.
     * PUT/PATCH /notifications/{id}
     *
     * @param int $id
     * @param UpdateNotificationsAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateNotificationsAPIRequest $request)
    {
        $input = $request->all();

        /** @var Notifications $notifications */
        $notifications = $this->notificationsRepository->find($id);

        if (empty($notifications)) {
            return $this->sendError('Notifications not found');
        }

        $notifications = $this->notificationsRepository->update($input, $id);

        return $this->sendResponse($notifications->toArray(), 'Notifications updated successfully');
    }

    /**
     * Remove the specified Notifications from storage.
     * DELETE /notifications/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Notifications $notifications */
        $notifications = $this->notificationsRepository->find($id);

        if (empty($notifications)) {
            return $this->sendError('Notifications not found');
        }

        $notifications->delete();

        return $this->sendSuccess('Notifications deleted successfully');
    }
}
