<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EChair extends Model
{
    protected $fillable = ['serial_number', 'model', 'status', 'assigned_to_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }
}
