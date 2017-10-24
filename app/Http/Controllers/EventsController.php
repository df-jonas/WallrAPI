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
use App\Text;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    public function Index()
    {
        return view('event');
    }

    public function GetAll()
    {
        return Auth::user()->events()->get();
    }

    public function GetOne($id)
    {
        if (isset($id)) {
            if (Auth::user()->events()->find($id) != null) {
                return Auth::user()->events()->where('id', $id)->with('texts')->get();
            }
            return response()->json(['statuscode' => 401, 'message' => "This event may not exist or is not yours."], 401);
        }
        return response()->json(['statuscode' => 400, 'message' => "@param 'id' not present."], 400);
    }

    public function Create(Request $request)
    {
        if (isset($request->name) && !isEmptyOrNullString($request->name)) {

            $event = new Event;

            $event->user_id = Auth::user()->id;
            $event->name = $request->name;
            $event->public_event_id = $this->getUniquePublicID();

            $event->save();

            return $event;
        }

        return response()->json(['statuscode' => 400, 'message' => "Some @params were not present."], 400);
    }

    public function Update(Request $request, $id)
    {
        if (isset($id)) {
            $event = Auth::user()->events()->find($id);
            if ($event != null) {

                if (isset($request->name) && !isEmptyOrNullString($request->name)) {
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

    private function getUniquePublicID()
    {
        $public_event_id = SecurityHelper::generateRandom(16);
        while (Event::query()->where('public_event_id', '=', $public_event_id)->first() != null) {
            $public_event_id = SecurityHelper::generateRandom(16);
        }
        return $public_event_id;
    }
}