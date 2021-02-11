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

    public function getListeners()
    {
        return [
            "featureUpdated.{$this->feature->id}" => '$refresh',
        ];
    }

    public function remove()
    {
        $this->feature->room->removeFeature($this->feature);
        $this->emitUp('featureDeleted');
    }

    public function toggleComplete()
    {
        $this->feature->toggleComplete();
        $this->emitUp('featureUpdated');
    }

    public function isSelectedFeature()
    {
        return $this->feature->id === $this->selectedFeatureId;
    }
}
