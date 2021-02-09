<?php

namespace App\Http\Livewire;

use App\Models\Feature;
use Livewire\Component;

class FeatureListItem extends Component
{
    public Feature $feature;
    public $selectedFeatureId;

    public function render()
    {
        return view('livewire.feature-list-item');
    }

    public function remove()
    {
        $this->feature->delete();
        $this->emitUp('featureDeleted');
    }

    public function toggleComplete()
    {
        $this->feature->isCompleted()
            ? $this->feature->uncomplete()
            : $this->feature->complete();
        $this->emitUp('featureUpdated');
    }

    public function isSelectedFeature()
    {
        return $this->feature->id === $this->selectedFeatureId;
    }
}
