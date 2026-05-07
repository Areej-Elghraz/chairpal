<?php

namespace App\Traits;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\StoreReviewRequest;
use App\Services\InteractionService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

trait HasInteractionActions
{
    protected $interactionService;

    public function __construct(InteractionService $interactionService)
    {
        $this->interactionService = $interactionService;
    }

    /**
     * Store a newly created review for a model.
     */
    protected function storeReview(StoreReviewRequest $request, Model $model): JsonResponse
    {
        $with = method_exists($this, 'relationships')
            ? $this->relationships($request->query('include', ''), auth('sanctum')->user())
            : [];

        $review = $this->interactionService->addReview(auth('sanctum')->user(), $model, $request->validated());

        if (!empty($with)) {
            $review->load($with);
        }

        return $this->successResponse(
            message: __('messages.actions.created_success', ['resource' => __('messages.resources.review.singular')]),
            status: 201,
            parameters: $review->toArray()
        );
    }

    /**
     * Toggle favorite status for a model.
     */
    protected function toggleFavorite(Model $model): JsonResponse
    {
        $isFavorited = $this->interactionService->toggleFavorite(auth('sanctum')->user(), $model);

        $message = $isFavorited
            ? __('messages.actions.added_to_favorites')
            : __('messages.actions.removed_from_favorites');

        return $this->successResponse(
            message: $message,
            status: 200,
            parameters: ['is_favorited' => $isFavorited]
        );
    }

    /**
     * Store a newly created comment for a model.
     */
    protected function storeComment(StoreCommentRequest $request, Model $model): JsonResponse
    {
        $comment = $this->interactionService->addComment(
            auth('sanctum')->user(),
            $model,
            $request->content,
            $request->get('parent_id', null) // Supports nested comments
        );

        return $this->successResponse(
            message: __('messages.actions.created_success', ['resource' => __('messages.resources.comment.singular')]),
            status: 201,
            parameters: (new \App\Http\Resources\CommentResource($comment))->resolve()
        );
    }

    /**
     * Retrieve paginated comments for a model.
     */
    protected function fetchComments(\Illuminate\Http\Request $request, Model $model): JsonResponse
    {
        $filters = $request->only(['sort_by', 'sort_direction', 'pagination', 'parent_id', 'search']);
        $comments = $this->interactionService->getComments($model, $filters);

        return $this->successResponse(
            message: __('messages.actions.retrieved_success', ['resource' => __('messages.resources.comment.plural') ?? 'Comments']),
            status: 200,
            parameters: $comments
        );
    }

    /**
     * Record a visit to a model.
     */
    protected function recordVisit(Model $model): JsonResponse
    {
        $this->interactionService->recordVisit(auth('sanctum')->user(), $model);

        return $this->successResponse(
            message: __('messages.actions.created_success', ['resource' => __('messages.resources.visitor.singular')]),
            status: 201
        );
    }
}