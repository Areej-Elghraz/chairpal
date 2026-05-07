<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'partner'      => [
                'id'    => $this->partner->id ?? null,
                'name'  => $this->partner->name ?? null,
                'image' => $this->partner->image ?? null,
            ],
            'unread_count' => $this->unread_count ?? 0,
            'last_message' => $this->whenLoaded('messages', function () {
                $msg = $this->messages->first();
                return $msg ? [
                    'content'    => $msg->content,
                    'type'       => $msg->type,
                    'created_at' => $msg->created_at?->diffForHumans(),
                ] : null;
            }),
            'updated_at'   => $this->updated_at?->diffForHumans(),
        ];
    }
}
