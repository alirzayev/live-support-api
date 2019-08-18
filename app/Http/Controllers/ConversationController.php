<?php

namespace App\Http\Controllers;

use App\Conversation;
use Illuminate\Auth\Access\AuthorizationException;

class ConversationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        //$this->middleware('isSupporter');
    }

    public function index()
    {
        $conversations = Conversation::all();
        return response()->json([
            'success' => true,
            'data' => $conversations
        ]);
    }


    public function show(Conversation $conversation)
    {

        try {
            $this->authorize('view', $conversation);
        } catch (AuthorizationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'You dont have permission to do this!'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $conversation->load('messages')
        ]);
    }

}
