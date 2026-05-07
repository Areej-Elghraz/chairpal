<?php

namespace App\Http\Controllers;

use App\Http\Requests\Chat\StoreMessageRequest;
use App\Models\Message;
use App\Models\User;
use App\Services\ChatService;
use Illuminate\Http\Request;

class ChatController extends ApiController
{
    protected $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['search', 'filter', 'pagination']);
        $conversations = $this->chatService->getConversations($request->user(), $filters);

        return $this->successResponse(
            message: __('messages.actions.retrieved_success', ['resource' => 'Chats']),
            status: 200,
            parameters: $conversations
        );
    }

    public function show(Request $request, $partnerId)
    {
        $request->validate(['search' => 'nullable|string', 'pagination' => 'nullable|integer']);
        $filters = $request->only(['search', 'pagination']);

        $messages = $this->chatService->getMessages($request->user(), $partnerId, $filters);

        return $this->successResponse(
            message: __('messages.actions.retrieved_success', ['resource' => 'Chat Messages']),
            status: 200,
            parameters: $messages
        );
    }

    public function store(StoreMessageRequest $request, User $user)
    {
        // Notice we explicitly inject User $user model via Route Model Binding if applicable
        // The policy will ensure they can message this user.
        // Assuming $user is the partner. If it's passed as $partnerId, we'd findOrFail it.
        // I will use $user->id.

        $message = $this->chatService->sendMessage(
            $request->user(),
            $user->id,
            $request->validated(),
            $request->file('attachment')
        );

        return $this->successResponse(
            message: __('messages.actions.created_success', ['resource' => 'Message']),
            status: 201,
            parameters: (new \App\Http\Resources\MessageResource($message))->resolve()
        );
    }

    public function destroy(Request $request, User $user)
    {
        $type = $request->query('type', 'for_me');
        $this->chatService->deleteConversation($request->user(), $user->id, $type);

        return $this->successResponse(
            message: __('messages.actions.deleted_success', ['resource' => 'Chat']),
            status: 200
        );
    }

    public function updateMessage(Request $request, \App\Models\Message $message)
    {
        $this->authorize('update', $message);
        $request->validate(['content' => 'required|string']);

        $message = $this->chatService->updateMessage($request->user(), $message, $request->only('content'));

        return $this->successResponse(
            message: __('messages.actions.updated_success', ['resource' => 'Message']),
            status: 200,
            parameters: (new \App\Http\Resources\MessageResource($message))->resolve()
        );
    }

    public function deleteMessage(Request $request, \App\Models\Message $message)
    {
        $this->authorize('delete', $message);
        $type = $request->query('type', 'for_me');
        $this->chatService->deleteMessage($request->user(), $message, $type);

        return $this->successResponse(
            message: __('messages.actions.deleted_success', ['resource' => 'Message']),
            status: 200
        );
    }
}