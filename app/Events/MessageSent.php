<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class MessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('message.' . $this->message->recepteur_id);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->message->id,
            'contenu' => $this->message->contenu,
            'expediteur_id' => $this->message->expediteur_id,
            'expediteur_type' => $this->message->expediteur_type,
            'recepteur_id' => $this->message->recepteur_id,
            'recepteur_type' => $this->message->recepteur_type,
            'created_at' => $this->message->created_at->toDateTimeString(),
        ];
    }
}
