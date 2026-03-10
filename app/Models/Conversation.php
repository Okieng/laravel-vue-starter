<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'type',
    ];

    public function participants()
    {
        return $this->hasMany(ConversationParticipant::class);
    }
}
