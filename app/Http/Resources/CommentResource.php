<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => [
                'id' => $this->user->id ?? null,
                'name' => $this->user->name ?? null,
                'image' => $this->user->image ?? null,
            ],
            'content' => $this->content,
            'replies_count' => $this->replies_count ?? 0,
            'likes_count' => $this->likes_count ?? 0,
            'created_at' => $this->created_at?->format('d M Y - h:i A'),
            'updated_at' => $this->updated_at?->format('d M Y - h:i A'),
        ];
    }
}
