<?php

namespace App\Http\Controllers;

use App\Models\SupportMessage;
use Illuminate\Http\Request;

class SupportController extends ApiController
{
    /**
     * Store a newly created support message in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:5000',
            'name'    => 'nullable|string|max:255',
            'email'   => 'nullable|email|max:255',
            'phone'   => 'nullable|string|max:20',
        ]);

        $user = auth('sanctum')->user();

        $supportMessage = SupportMessage::create([
            'user_id' => $user ? $user->id : null,
            'name'    => $user ? $user->name  : $request->input('name'),
            'email'   => $user ? $user->email : $request->input('email'),
            'phone'   => $user ? $user->phone : $request->input('phone'),
            'message' => $request->input('message'),
        ]);

        return response()->json([
            'message' => __('messages.support_message_sent'),
            'data'    => clone $supportMessage,
        ], 201);
    }
}
