<div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 mt-[7rem] py-4 lg:pt-8 lg:pb-24">
    <div class="w-full mx-auto block">

        <!-- Enhanced Header section -->
        <div class="flex flex-col lg:flex-row rounded-lg gap-4 my-4 p-6 bg-gradient-to-r from-primary-50 to-primary-100 dark:from-zinc-800 dark:to-zinc-900 shadow-sm border border-primary-200 dark:border-zinc-700 relative mx-auto">
            <div class="lg:max-w-xl w-full">
                <h2 class="mb-3 text-3xl sm:text-4xl md:text-5xl font-bold text-zinc-900 dark:text-white">
                    @lang('Live Streams')
                </h2>
                <p class="text-base text-gray-600 dark:text-zinc-300">
                    Join exclusive live streams from your favorite creators. Interact in real-time and enjoy premium content.
                </p>
                <div class="mt-4 flex gap-3">
                    <button class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-full text-sm font-medium transition-all">
                        Start Your Stream
                    </button>
                    <button class="px-4 py-2 bg-white hover:bg-gray-50 text-primary-600 border border-primary-200 rounded-full text-sm font-medium transition-all">
                        Browse Creators
                    </button>
                </div>
            </div>
            <div class="w-full flex items-center justify-center rounded-lg overflow-hidden shadow-lg">
                <div class="relative w-full h-full aspect-video">
                    <img src="{{ url('public/img/explore/projects/1.jpg') }}"
                         class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-4">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center animate-pulse">
                                <div class="w-2 h-2 bg-white rounded-full"></div>
                            </div>
                            <span class="text-white font-medium text-sm">Live Now: {{ number_format($featuredStreamViewers ?? 0) }} viewers</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mt-8">
            <!-- Left sidebar filters - Improved -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-4">
                    <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm dark:shadow-none border border-gray-200 dark:border-zinc-700 p-4">
                        <h3 class="font-bold text-lg text-gray-800 dark:text-zinc-200 mb-3">Filters</h3>

                    </div>
                </div>
            </div>

            <!-- Streams grid - Improved Layout -->
            <div class="lg:col-span-3">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5"
                     x-data="{
                        init() {
                            // Initialize intersection observer for infinite scroll
                            const observer = new IntersectionObserver((entries) => {
                                entries.forEach(entry => {
                                    if (entry.isIntersecting && !@this.loading && @this.hasMore) {
                                        @this.loadMore();
                                    }
                                });
                            }, { threshold: 0.1 });

                            const trigger = document.querySelector('#load-more-trigger');
                            if (trigger) observer.observe(trigger);

                            // Cleanup when component is destroyed
                            return () => observer.disconnect();
                        }
                     }">
                    @forelse ($streams as $stream)

                    @if($stream->user)
                            <div class="border border-gray-200 dark:border-zinc-700 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300 group bg-white dark:bg-zinc-800"
                            >
                            <!-- Video Player -->
                            <div class="video-container relative h-72 w-full aspect-video bg-black overflow-hidden">
                                @if($stream->live)

                                    <img
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                        muted
                                        playsinline
                                        preload="metadata"
                                        src="{{ asset('storage/' . $stream->thumb?->file_url ?? placeholder_img() ) }}"
                                    />
                                @else
                                    <!-- Recorded stream -->
                                    <video
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                        loop
                                        muted
                                        playsinline
                                        preload="none"
                                        poster="{{ asset('storage/' . $stream->thumb?->file_url ?? placeholder_img() ) }}"
                                        data-src="{{ $stream->stream_url }}">

                                    </video>
                                @endif

                                @if($stream->live)
                                    <div class="absolute top-3 left-3 bg-red-600 text-white px-2 py-1 rounded-md text-xs flex items-center gap-1">
                                        <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                                        <span>LIVE</span>
                                    </div>
                                @else
                                    <div class="absolute top-3 left-3 bg-green-500 text-white px-2 py-1 rounded-md text-xs flex items-center gap-1">
                                        <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                                        <span>RECORDED</span>
                                    </div>
                                @endif

                                <!-- Viewers count -->
                                <div class="absolute top-3 right-3 bg-black/60 text-white px-2 py-1 rounded-md text-xs">
                                    <x-icon name="users" class="w-3 h-3 inline mr-1" />
                                    <span></span>
                                </div>

                                <!-- Hover preview text -->
                                <div class="preview-text absolute bottom-3 left-3 bg-black/60 text-white px-2 py-1 rounded-md text-xs flex items-center gap-1 transition-opacity duration-300">
                                    <x-icon name="play" class="w-4 h-4" />
                                    <span>Hover to preview</span>
                                </div>
                            </div>

                            <!-- Stream Info -->
                            <div class="p-4">
                                <div class="flex items-start gap-3" >
                                    <img
                                        src="{{ placeholder_img() }}" data-src="{{ src($stream->user->avatar) }}"
                                        alt="{{ $stream->user->username }}"

                                        class="w-12 h-12 rounded-full object-cover lazy border-2 border-white dark:border-zinc-800 shadow-sm"
                                    >
                                    <div class="flex-1">
                                        <div class="flex items-center gap-1 mt-1">
                                            <span class="text-sm text-gray-600 dark:text-zinc-400">{{ $stream->user ? $stream->user->fullname : 'Unknown User' }}</span>
                                            @if($stream->user && $stream->user->status === 'verified')
                                                <img src="{{ url('public/img/auth/verified-badge.svg') }}"
                                                     class="h-3 w-3"
                                                     alt="Verified">
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-zinc-400 mt-1">{{ $stream->user ? $stream->user->username : 'unknown' }}</p>
                                    </div>
                                    <button class="text-gray-400 hover:text-primary-500 transition-colors">
                                        <x-icon name="heart" class="w-5 h-5" />
                                    </button>
                                </div>

                                <h3 class="font-bold text-gray-800 dark:text-zinc-200 line-clamp-1 pt-2">
                                    {{ $stream->title ?: 'Untitled Stream' }}
                                </h3>

                                <div class="flex items-center justify-between mt-4">
                                    <span class="text-xs text-gray-500 dark:text-zinc-400">
                                        <x-icon name="clock" class="w-3 h-3 inline mr-1" />
                                        {{ $stream->created_at->diffForHumans() }}
                                    </span>
                                    <div class="flex items-center gap-3 text-xs text-gray-500 dark:text-zinc-400">
                                        <span class="flex items-center gap-1">
                                            <x-icon name="eye" class="w-3 h-3" />
                                            {{ number_format($stream->views_count ?? 0) }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                              <x-icon name="chat-alt-2" class="w-3 h-3" />
                                            {{ number_format($stream->comments_count ?? 0) }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <x-icon name="heart" class="w-3 h-3" />
                                            {{ number_format($stream->likes_count ?? 0) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Button based on stream status -->
                                @if($stream->live)
                                    <a
                                        href="{{ url('/live_streams/watch/'.$stream->uid.'/hash/'.$stream->session_id) }}"
                                        class="w-full mt-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg text-sm font-medium transition-colors flex items-center justify-center gap-2">
                                        <x-icon name="play" class="w-8 h-8" />
                                        <span>Join Stream</span>
                                    </a>
                                @else
                                    <a
                                        href="{{ url('/live_streams/watch/'.$stream->uid.'/hash/'.$stream->session_id) }}"
                                        class="w-full mt-4 py-2 bg-green-500 hover:bg-green-400 text-white rounded-lg text-sm font-medium transition-colors flex items-center justify-center gap-2">
                                        <x-icon name="play" class="w-8 h-8" />
                                        <span>Watch Stream</span>
                                    </a>
                                @endif
                            </div>
                        </div>

                    @endif
                    @empty
                        <div class="col-span-3 flex flex-col items-center justify-center py-12">
                            <div class="w-24 h-24 bg-gray-100 dark:bg-zinc-700 rounded-full flex items-center justify-center mb-4">
                                <x-icon name="tabler-video" class="w-10 h-10 text-gray-400 dark:text-zinc-500" />
                            </div>
                            <h3 class="text-lg font-medium text-gray-700 dark:text-zinc-300 mb-2">No streams available</h3>
                            <p class="text-gray-500 dark:text-zinc-400 text-center max-w-md mx-auto">
                                There are currently no live streams. Check back later or follow creators to be notified when they go live.
                            </p>
                            <button class="mt-4 px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-full text-sm font-medium transition-colors">
                                Discover Creators
                            </button>
                        </div>
                    @endforelse
                </div>

                <!-- Enhanced Load More Button -->
                @if($hasMore)
                    <div class="mt-8 text-center">
                        <button wire:click="loadMore"
                                class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors duration-300 inline-flex items-center gap-2"
                                wire:loading.attr="disabled">
                            <span wire:loading.remove>
                                <x-icon name="arrow-path" class="w-5 h-5" />
                                <span>Load more streams</span>
                            </span>
                            <span wire:loading>
                                <div class="flex items-center justify-center gap-2">
                                    <div class="w-5 h-5 border-2 border-white border-t-transparent rounded-full animate-spin"></div>
                                    <span>Loading...</span>
                                </div>
                            </span>
                        </button>
                    </div>
                    <div id="load-more-trigger" wire:ignore class="h-1"></div>
                @endif
            </div>
        </div>



    </div>


</div>

