<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.presence', function ($user) {
    return [
        'id'   => $user->id,
        'name' => $user->name,
    ];
});