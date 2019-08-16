<?php

namespace App\Http\Controllers\Auth;

use App\Conversation;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required|email',
                'name' => 'required',
                'subject' => 'required'
            ]);

        $email = $request->get('email');
        $name = $request->get('name');
        $subject = $request->get('subject');

        $user = User::updateOrCreate(
            ['email' => $email],
            ['name' => $name]
        );

        if ($user) {
            Conversation::create([
                'subject' => $subject,
                'customer_id' => $user->id
            ]);
        }

        $token = $user->createToken('Chat Token')->accessToken;
        return response()->json(['access_token' => $token]);
    }
}
