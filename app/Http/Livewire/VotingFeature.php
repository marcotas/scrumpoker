<?php

namespace App\Http\Livewire;

use App\Models\Feature;
use App\Models\Participant;
use Livewire\Component;

class VotingFeature extends Component
{
    public $selectedFeatureId;
    public ?Feature $feature;
    public $ratings = [
        '?', 1, 2, 3, 5, 8, 10, 13, 21, 40, 100
    ];

    public function mount($selectedFeatureId)
    {
        $this->feature = Feature::find($selectedFeatureId);
    }

    public function render()
    {
        return view('livewire.voting-feature');
    }

    public function getParticipantsProperty()
    {
        if (!$this->feature) {
            return [];
        }

        return $this->feature->room->fresh()->participants;
    }

    public function remove()
    {
        $this->feature->room->removeFeature($this->feature);
        $this->feature = null;
        $this->emitUp('featureDeleted');
    }

    public function removeParticipant(Participant $participant)
    {
        $participant->delete();
        $this->emitSelf('$refresh');
    }

    public function toggleComplete()
    {
        $this->feature->toggleComplete();
        $this->emit('featureUpdated.' . $this->feature->id);
    }
}
