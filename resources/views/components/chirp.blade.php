@props(['chirp'])

<div class="card bg-base-100 shadow" id="chirp-card-{{ $chirp->id }}">
    <div class="card-body">
        <div class="flex space-x-3">
            @if($chirp->user)
                <div class="avatar">
                    <div class="size-10 rounded-full">
                        <img src="https://avatars.laravel.cloud/{{ urlencode($chirp->user->email) }}"
                             alt="{{ $chirp->user->name }}'s avatar"
                             class="rounded-full"/>
                    </div>
                </div>
            @else
                <div class="avatar placeholder">
                    <div class="size-10 rounded-full">
                        <img src="https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth"
                             alt="Anonymous User"
                             class="rounded-full"/>
                    </div>
                </div>
            @endif

            <div class="min-w-0 flex-1">
                <div class="flex justify-between w-full">
                    <div class="flex items-center gap-1">
                        <span class="text-sm font-semibold">{{ $chirp->user ? $chirp->user->name : 'Anonymous' }}</span>
                        <span class="text-base-content/60">·</span>
                        <span class="text-sm text-base-content/60">{{ $chirp->created_at->diffForHumans() }}</span>
                        {{--                        IN ENGLISH: if chirp's updated is greater than (gt) than its created_at + 5 seconds--}}
                        @if ($chirp->updated_at->gt($chirp->created_at->addSeconds(5)))
                            <span class="text-base-content/60">.</span>
                            <span class="text-sm text-base-content/60 italic">Edited</span>
                        @endif
                    </div>

                    {{-- IN ENGLISH: if auth got checked and auth id is equal to current chirp's user_id --}}
                    {{-- @if (auth()->check() && auth()->id() === $chirp->user_id)--}}
                    @can('update', $chirp)
                        <div class="flex gap-1">
                            {{--                    Edit--}}
                            <a href="/chirps/{{ $chirp->id }}/edit" class="btn btn-ghost btn-xs">
                                Edit
                            </a>

                            {{--                    Delete--}}
                            <form method="POST" action="/chirps/{{ $chirp->id }}">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="btn btn-ghost btn-xs text-error"
                                    onClick="return confirm('Are you sure you want to delete this chirp?')"
                                >
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endcan
                    {{--  @endif--}}
                </div>

                <p class="mt-1 mb-3">
                    {{ $chirp->message }}
                </p>
                {{-- buttons --}}
                <div
                    class="likes-wrapper flex flex-row justify-start gap-3 w-full items-center border-t border-gray-400 pt-3">
                    <span class="text-xs">
                        <span class="font-bold likes-count"
                              id="likes-{{ $chirp->id }}">{{ $chirp->likes->count() }}</span> <span
                            class="text-gray-500">Likes</span>
                    </span>

                    <button type="button" data-id="{{$chirp->id}}"
                            data-liked="{{ $chirp->likes->contains('user_id', auth()->id()) ? '1' : '0' }}"
                            onclick="thingy(this, {{ auth()->id() ? "true" : "false" }})"
                            class="toggleBtn btn btn-info btn-xs {{ $chirp->likes->contains('user_id', auth()->id()) ? "" : "btn-outline"}}">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             fill="{{ $chirp->likes->contains('user_id', auth()->id()) ? "yes" : "none" }}"
                             viewBox="0 0 24 24"
                             stroke-width="2.5" stroke="currentColor" class="size-[1.2em]">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                        </svg>
                        <span id="text-{{ $chirp->id }}">
                        {{ $chirp->likes->contains('user_id', auth()->id()) ? "Unlike" : "Like" }}
                        </span>
                    </button>

                    <button onclick="bookmark(this)"
                            class="ml-auto btn btn-xs {{ $chirp->bookmarks->contains('user_id', auth()->id()) ? "btn-neutral" : "btn-ghost" }}"
                            data-id="{{ $chirp->id }}"
                            data-bookmarked="{{ (bool)$chirp->bookmarks->contains('user_id', auth()->id()) }}"
                    >
                        {{ $chirp->bookmarks->contains('user_id', auth()->id()) ? "Unbookmark" : "Bookmark" }}
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>


