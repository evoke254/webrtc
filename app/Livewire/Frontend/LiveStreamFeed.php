<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\LiveStream;

use Mary\Traits\Toast;


class LiveStreamFeed extends Component
{

    public $streams;
    public function mount()
    {
        $this->streams = LiveStream::all();
    }

    public function render()
    {
        return view('livewire.frontend.live-stream-feed');
    }
}
