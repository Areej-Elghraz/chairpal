<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;
use App\Models\Place;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;
use App\Models\Organization;
use App\Traits\HasInteractionActions;

class ReviewController extends ApiController
{
    use HasInteractionActions;

    public function relationships($include, User $user)
    {
        $with = array_filter(explode(',', $include));
        $with = array_intersect($with, Review::ALLOWED_RELATIONS);
        $with = collect($with)->mapWithKeys(function ($relation) use ($user) {
            $access = [
                'reviewable',
            ];
            if (in_array($relation, $access)) {
                return [$relation => function ($q) use ($user) {
                    $q->accessibleBy($user);
                }];
            }
            return [$relation => fn($q) => $q];
        })->toArray();
        return $with;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created review for a place.
     */
    public function store(StoreReviewRequest $request, Place $place)
    {
        $this->authorize('create', [Review::class, $request->validated()]);
        return $this->storeReview($request, $place);
    }

    /**
     * Store a newly created review for an organization.
     */
    public function storeOrganization(StoreReviewRequest $request, Organization $organization)
    {
        $this->authorize('create', [Review::class, $request->validated()]);
        return $this->storeReview($request, $organization);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Review $review)
    {
        // // Add authorization check here if not using Policies yet
        // if ($review->user_id !== Auth::id()
        //     or ($review->reviewable_type == 'App\Models\Organization' and $review->organization->owner_id == Auth::id())
        //     or ($review->reviewable_type == 'App\Models\Place' and $review->place->organization?->owner_id == Auth::id())) { // && !Auth::user()->isAdmin()
        //     return $this->errorResponse(
        //         message: __('auth.unauthorized'),
        //         status: 403
        //     );
        // }
        $this->authorize('delete', $review);

        $this->interactionService->deleteReview(Auth::user(), $review);

        return $this->successResponse(
            message: __('messages.actions.deleted_success', ['resource' => __('messages.resources.review.singular')]),
            status: 200
        );
    }
}
