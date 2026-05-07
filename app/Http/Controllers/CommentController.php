<?php

namespace App\Http\Controllers;

use App\Http\Requests\Community\UpdateCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Traits\HasInteractionActions;
use Illuminate\Http\Request;

class CommentController extends ApiController
{
    use HasInteractionActions;

    public function storePost(StoreCommentRequest $request, Post $post)
    {
        $this->authorize('create', Comment::class);
        return $this->storeComment($request, $post);
    }

    public function indexPost(Request $request, Post $post)
    {
        return $this->fetchComments($request, $post);
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);
        if ($comment->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        $comment->update(['content' => $request->get('content')]);

        return $this->successResponse(
            message: __('messages.actions.updated_success', ['resource' => __('messages.resources.comment.singular')]),
            status: 200,
            parameters: (new \App\Http\Resources\CommentResource($comment))->resolve()
        );
    }

    public function destroy(Request $request, Comment $comment)
    {
        $this->authorize('delete', $comment);
        if ($comment->user_id !== $request->user()->id) {
            abort(403, 'Unauthorized');
        }

        $comment->delete();

        return $this->successResponse(
            message: __('messages.actions.deleted_success', ['resource' => __('messages.resources.comment.singular')]),
            status: 200
        );
    }

    public function likes(Comment $comment, Request $request)
    {
        $likes = $comment->likes()->with('user:id,name,image')->cursorPaginate($request->get('pagination', 15));
        $users = $likes->getCollection()->map(fn($like) => $like->user);

        return $this->successResponse(
            message: __('messages.actions.retrieved_success', ['resource' => __('messages.resources.user.plural') ?? 'Users']),
            status: 200,
            parameters: [
                'likes' => $users,
                'next_cursor' => $likes->nextCursor()?->encode(),
                'prev_cursor' => $likes->previousCursor()?->encode(),
            ]
        );
    }
}
