<?php

namespace App\Http\Middleware;

use Closure;

class NotificationsArrangement
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $notifications = null;
        
        if(auth()->user()->role == 'customer'){
            $notifications = auth()->user()->unread_notifications;
            foreach ($notifications as $notification){
                $videoRequest = \App\Models\VideoRequests::find($notification->reference_id);
                $video = $videoRequest->video;
                $notification->message = 'Your request for access of video '.$video->title.' has been verified.';
            }
            if(count($notifications) == 0) $notifications = null;
        } else {
            $video_requests_unverified = \App\Models\VideoRequests::whereNull('verified_at')->orderBy('created_at', 'desc')->get();
            
            if(count($video_requests_unverified) > 0){
                $notification = [];
                $notification['id'] = null;
                $notification['message'] = count($video_requests_unverified).' video access request waiting to be verified';
                $notification['created_at'] = null;
                
                $notifications = json_decode(json_encode([$notification]));
                $notifications[0]->created_at = $video_requests_unverified[0]->created_at;
            }
        }

        if(!is_null($notifications))
            \Session::flash('notifications', $notifications);

        return $next($request);
    }
}
