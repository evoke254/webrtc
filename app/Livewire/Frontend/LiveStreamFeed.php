<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\LiveStream;

use Mary\Traits\Toast;


class LiveStreamFeed extends Component
{

    public $streams = [];
    public $filter_pblc_prvt = 'public';
    public $user;
    public $perPage = 4;
    public $loading = false;
    public $hasMore = true;
    public $totalViewers = 900;
    public $activeStreams = 100;
    public $featuredStream = null;

    public $showStreamModal = false;
    public $currentStream = [];
    public $currentStreamId;
    public function mount()
    {
        $this->streams = LiveStream::all();
        $this->user = auth()->user();
        $this->loadStreams();
    }

        public function loadStreams()
    {
        if ($this->loading || !$this->hasMore) {
            return;
        }

        $this->loading = true;

        $newStreams = LiveStream::orderByDesc('id')
            ->skip(count($this->streams))
            ->take($this->perPage)
            ->get();

        $this->streams = [...$this->streams, ...$newStreams];
        $this->hasMore = $newStreams->count() >= $this->perPage;
        $this->loading = false;
    }

    public function loadMore()
    {
        $this->loadStreams();
    }

    public function render()
    {
        return view('livewire.frontend.live-stream-feed');
    }
}
