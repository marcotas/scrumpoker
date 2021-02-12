<?php

namespace App\Http\Livewire;

use App\Models\Participant;
use App\Models\Room;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ParticipantForm extends Component
{
    public $name;
    public Room $room;

    protected $rules = [
        'name' => 'required|string|max:32',
    ];

    public function render()
    {
        return view('livewire.participant-form');
    }

    public function join()
    {
        /** @var Participant $participant */
        $participant = $this->room->participants()
            ->create($this->validate());
        Session::put('participant', $participant->id);

        return redirect(route('room.join', $this->room));
    }
}
