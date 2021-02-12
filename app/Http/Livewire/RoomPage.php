<?php

namespace App\Http\Livewire;

use App\Models\Feature;
use App\Models\Participant;
use App\Models\Room;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Component;

/**
 * @property-read Collection $featureList
 * @property-read Collection $participants
 * @package App\Http\Livewire
 */
class RoomPage extends Component
{
    public Room $room;
    public $newFeature;
    public $showCompleted = false;
    public ?Participant $participant;

    protected $rules = [
        'newFeature' => 'required|string|max:512',
    ];

    protected $listeners = [
        'featureDeleted' => '$refresh',
        'featureUpdated' => '$refresh',
        'featureSelected' => 'setSelectedFeature'
    ];

    public function mount(? Room $room)
    {
        $this->room = $room->exists
            ? $room
            : $this->getRoom();
    }

    public function render()
    {
        return view('livewire.room-page')
            ->layout('layouts.dark');
    }

    public function getFeatureListProperty()
    {
        return $this->room->features()
            ->latest()
            ->when(!$this->showCompleted, fn ($query) =>
                $query->whereNull('completed_at'))
            ->get();
    }

    public function getCompletedFeatureCountProperty()
    {
        return $this->room->features()->completed()->count();
    }

    public function addNewFeature()
    {
        $this->validate();
        $this->room->features()->create([
            'name' => $this->newFeature
        ]);
        $this->newFeature = null;
    }

    public function setSelectedFeature(Feature $feature)
    {
        $this->room->update([
            'selected_feature_id' => $feature->id ?? null,
        ]);
    }

    private function getRoom(): Room
    {
        $roomId = Session::get('roomId');
        /** @var Room $room */
        $room = Room::find($roomId) ?? Room::create();
        Session::put('roomId', $room->id);
        if ($room->wasRecentlyCreated) {
            Session::put('isManager', true);
        }

        return $room;
    }
}
