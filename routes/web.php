<?php

use App\Livewire\Frontend\LiveStreamFeed;
use Livewire\Volt\Volt;


Route::get('/', LiveStreamFeed::class);


Route::prefix('admin')->group(function () {
Route::get('stream', LiveStreamList::class);
});
