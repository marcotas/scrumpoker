<?php

namespace App\Observers;

use App\Models\Room;
use Illuminate\Support\Str;

class RoomObserver
{
    public function creating(Room $room)
    {
        $room->token = Str::random();
    }
}
