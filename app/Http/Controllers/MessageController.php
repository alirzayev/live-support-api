<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     * @param $conversation_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function fetchMessages($conversation_id)
    {
        $messages = Message::where('conversation_id', $conversation_id)->with('user')->get();
        return $messages;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function sendMessage(Request $request)
    {

        $user = $request->user('api');
        // Store the new message
        $message = new Message();
        $message->user_id = $user->id;
        $message->conversation_id = $request->get('conversation_id');
        $message->text = $request->get('text');
        $message->save();
        // Announce that a new message has been posted
        //broadcast(new MessagePosted($message, $user))->toOthers();
        return response()->json([
            'success' => true,
            'message' => 'New message has created!',
            'data' => $message
        ], 200);
    }
}
