<?php

namespace App\Services;

use Pusher\Pusher;

class PusherService
{
    protected $pusher;

    public function __construct()
    {
        $this->pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
                'encrypted' => true,
            ]
        );
    }

    public function trigger(string $channel, string $event, array $data): void
    {
        $this->pusher->trigger($channel, $event, $data);
    }
}