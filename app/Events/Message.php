<?php

namespace App\Events;

use App\Models\Chat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Message implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;
    // Dispatchable, 

    public $data;

    public function __construct($data)
    { 
        $this->data = $data;
    }

    public function broadcastOn()
    {   
        return new Channel('chat');
    }

    public function broadcastWith()
    {
        return ['data' => $this->data];
    }

    // public function broadcastAs(){
    //     return 'message';
    // }
}
