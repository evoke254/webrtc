<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\LiveStream;
class LiveStreamFeed extends Component
{

    public function mount()
    {
//        dd('test');
    }

    public function render()
    {
        return view('livewire.frontend.live-stream-feed');
    }
}
