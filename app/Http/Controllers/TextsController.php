<?php
/**
 * Created by PhpStorm.
 * User: Jonas
 * Date: 23/10/2017
 * Time: 22:39
 */

namespace App\Http\Controllers;

use App\Event;
use App\Helpers\StringHelper;
use App\Text;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TextsController extends Controller
{
    /**
     * Gets last 10 texts, more if 'amount' with an integer value in the request is provided.
     * @param Request $request
     * @param $event_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function GetAll(Request $request, $event_id)
    {
        if (isset($event_id)) {

            $event = null;

            if (Event::find($event_id) != null) {
                $event = Event::find($event_id);
            }
            else if (Event::query()->where('public_event_id', '=', $event_id)->first() != null) {
                $event = Event::query()->where('public_event_id', '=', $event_id)->first();
            }

            if ($event != null) {
                $texts = Text::query()
                    ->orderBy('id', 'desc')
                    ->where('event_id', '=', $event->id)
                    ->get()
                    ->makeVisible('source');

                $max = sizeof($texts);
                for ($i = 0; $i < $max; $i++) {
                    $texts[$i]->source = StringHelper::mask($texts[$i]->source, '*');
                }

                if (isset($request->amount) && $request->amount > 0) {
                    return $texts->take($request->amount);
                }
                return $texts->take(10);
            }
            return response()->json(['statuscode' => 401, 'message' => "This event may not exist."], 401);
        }
        return response()->json(['statuscode' => 400, 'message' => "@param 'id' not present."], 400);
    }

    public function GetAllPost(Request $request, $event_id, $last_msg_id)
    {
        if (isset($event_id)) {

            $event = null;

            if (Event::find($event_id) != null && isset($last_msg_id)) {
                $event = Event::find($event_id);
            }
            else if (Event::query()->where('public_event_id', '=', $event_id)->first() != null) {
                $event = Event::query()->where('public_event_id', '=', $event_id)->first();
            }

            if ($event != null) {
                $texts = Text::query()
                    ->orderBy('id', 'desc')
                    ->where('event_id', '=', $event->id)
                    ->where('id', '>', $last_msg_id)
                    ->get()
                    ->makeVisible('source');

                $max = sizeof($texts);
                for ($i = 0; $i < $max; $i++) {
                    $texts[$i]->source = StringHelper::mask($texts[$i]->source, '*');
                }

                if (isset($request->amount) && $request->amount > 0) {
                    return $texts->take($request->amount);
                }
                return $texts;
            }
            return response()->json(['statuscode' => 401, 'message' => "This event may not exist."], 401);
        }
        return response()->json(['statuscode' => 400, 'message' => "Some @params were not present."], 400);
    }

    /**
     * Creates a new text
     * @param Request $request
     * @param int $event_id
     * @return object Confirmation
     */
    public function Create(Request $request, $event_id)
    {
        if (isset($event_id) && isset($request->message) && isset($request->source)) {
            if (Auth::user()->events()->where('id', $event_id)->first() != null) {
                $text = new Text;

                $text->event_id = $event_id;
                $text->source = $request->source;
                $text->content = $request->message;

                $text->save();

                return response()->json(['statuscode' => 200, 'message' => "created"], 200);
            }
            return response()->json(['statuscode' => 401, 'message' => "This event may not exist or is not yours."], 401);
        }
        return response()->json(['statuscode' => 400, 'message' => "Some @params were not present."], 400);
    }
}