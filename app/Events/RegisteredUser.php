<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
<<<<<<< HEAD
=======

>>>>>>> 2caf74e (task_3)
use App\Models\User;

class RegisteredUser
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
<<<<<<< HEAD
=======

>>>>>>> 2caf74e (task_3)
    public $user;
    /**
     * Create a new event instance.
     */
    public function __construct (User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
