<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'conversation_id',
        'sender_id',
        'type',
        'content',
        'attachment',
        'is_read',
        'deleted_by_sender',
        'deleted_by_receiver'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'deleted_by_sender' => 'boolean',
        'deleted_by_receiver' => 'boolean',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y - h:i A');
    }

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}