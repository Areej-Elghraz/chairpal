<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'user'           => [
                'id'    => $this->user->id ?? null,
                'name'  => $this->user->name ?? null,
                'image' => $this->user->image ?? null,
            ],
            'content'        => $this->content,
            'images'         => $this->images,
            'files'          => $this->files,
            'likes_count'    => $this->likes_count ?? 0,
            'comments_count' => $this->comments_count ?? 0,
            'shares_count'   => $this->shares_count ?? 0,
            'shared_post'    => $this->whenLoaded('sharedPost', fn() => new PostResource($this->sharedPost)),
            'created_at'     => $this->created_at?->format('d M Y - h:i A'),
            'updated_at'     => $this->updated_at?->format('d M Y - h:i A'),
        ];
    }
}
