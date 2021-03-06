<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 23/10/2017
 * Time: 22:26
 */

namespace App\Http\Controllers;

use App\Event;
use App\Helpers\SecurityHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    /**
     * Returns home view.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Index()
    {
        return view('event');
    }

    /**
     * Returns all events for the logged in user.
     * @return array User events
     */
    public function GetAll()
    {
        return Auth::user()->events()->get();
    }

    /**
     * Returns the event of a user. Gives 400 if not valid, 401 if non-existent or unauthorized.
     * @param int $id
     * @return array Array of one event.
     */
    public function GetOne($id)
    {
        if (isset($id)) {
            if (Auth::user()->events()->find($id) != null) {
                return Auth::user()->events()
                    ->where('id', $id)
                    ->get();
            }
            return response()->json(['statuscode' => 401, 'message' => "This event may not exist or is not yours."], 401);
        }
        return response()->json(['statuscode' => 400, 'message' => "@param 'id' not present."], 400);
    }

    /**
     * Creates an event if user is logged in and a 'name' in the request is provided.
     * @param Request $request
     * @return Event Created event
     */
    public function Create(Request $request)
    {
        if (isset($request->name)) {

            $event = new Event;

            $event->user_id = Auth::user()->id;
            $event->name = $request->name;
            $event->public_event_id = $this->getUniquePublicID();

            $event->save();

            return $event;
        }

        return response()->json(['statuscode' => 400, 'message' => "Some @params were not present."], 400);
    }

    /**
     * Updates an event if user is logged in and a name is provided. Alternatively, @renew with value 'y' can be used to regenerate the public identifier.
     * @param Request $request
     * @param $id
     * @return Event Updated event
     */
    public function Update(Request $request, $id)
    {
        if (isset($id)) {
            $event = Auth::user()->events()->find($id);
            if ($event != null) {

                if (isset($request->name)) {
                    $event->name = $request->name;
                }

                if (isset($request->renew) && $request->renew == "y") {
                    $event->public_event_id = $this->getUniquePublicID();
                }

                $event->save();

                return $event;
            }
            return response()->json(['statuscode' => 401, 'message' => "This event may not exist or is not yours."], 401);
        }
        return response()->json(['statuscode' => 400, 'message' => "@param 'id' not present."], 400);
    }

    /**
     * Provides a random generated string of 16 characters to use as Unique Public ID
     * @return string unique public id
     */
    private function getUniquePublicID()
    {
        $public_event_id = SecurityHelper::generateRandom(16);
        while (Event::query()->where('public_event_id', '=', $public_event_id)->first() != null) {
            $public_event_id = SecurityHelper::generateRandom(16);
        }
        return $public_event_id;
    }
}