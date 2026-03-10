<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\ConversationParticipant;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller
{
    public function getOrCreatePrivate(int $userId)
    {
        $authUserId = auth()->id();

        if ($authUserId === $userId) {
            abort(400, 'Cannot chat with yourself');
        }

        $conversation = DB::transaction(function () use ($authUserId, $userId) {

            $existing = Conversation::where('type', 'private')
                ->whereHas(
                    'participants',
                    fn($q) =>
                    $q->where('user_id', $authUserId)
                )
                ->whereHas(
                    'participants',
                    fn($q) =>
                    $q->where('user_id', $userId)
                )
                ->withCount('participants')
                ->having('participants_count', 2)
                ->lockForUpdate()
                ->first();

            if ($existing) {
                return $existing;
            }

            $conversation = Conversation::create([
                'type' => 'private',
            ]);

            ConversationParticipant::insert([
                [
                    'conversation_id' => $conversation->id,
                    'user_id' => $authUserId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'conversation_id' => $conversation->id,
                    'user_id' => $userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            return $conversation;
        });

        return redirect()->route('chat.show', $conversation->id);
    }
}
