<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            // 'sender_id'  => $this->sender_id,
            'sender'     => $this->whenLoaded('sender', fn() => new PostResource($this->sender)),
            'type'       => $this->type,
            'content'    => $this->content,
            'attachment' => $this->attachment ? asset('storage/' . $this->attachment) : null,
            'is_read'    => (bool) $this->is_read,
            // 'is_read' => array_key_exists('is_read', $this->casts ?? [])
            //     ? (bool) $this->is_read
            //     : $this->is_read,
            // 'is_read'    => current($this->casts) && array_key_exists('is_read', $this->casts) ? (bool)$this->is_read : $this->is_read,
            'created_at' => $this->created_at?->diffForHumans(),
            'updated_at' => $this->updated_at?->diffForHumans(),
        ];
    }
}