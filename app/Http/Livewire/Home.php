<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $cards = ['3', '2', '1'];

    public function createRoom()
    {
        dd('create room', $this->cards);
    }

    public function render()
    {
        return view('livewire.home')
            ->layout('layouts.dark');
    }
}
