<?php

use App\Models\Participant;
use App\Models\Room;
use Illuminate\Support\Facades\Session;

function room(): ?Room
{
    return Room::find(Session::get('roomId'));
}

function participant(): ?Participant
{
    return Participant::find(session('participant'));
}

function isManager()
{
    if (!room() || !Session::has('isManager')) {
        return false;
    }

    return Session::get('isManager');
}
