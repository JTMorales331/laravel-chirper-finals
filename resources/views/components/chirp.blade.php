
@props(['chirp'])

<div class="card bg-base-100 shadow">
    <div class="card-body">
        <div class="flex space-x-3">
            @if($chirp->user)
                <div class="avatar">
                    <div class="size-10 rounded-full">
                        <img src="<https://avatars.laravel.cloud/>{{ urlencode($chirp->user->email) }}"
                             alt="{{ $chirp->user->name }}'s avatar"
                             class="rounded-full" />
                    </div>
                </div>
            @else
                <div class="avatar placeholder">
                    <div class="size-10 rounded-full">
                        <img src="<https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth>"
                             alt="Anonymous User"
                             class="rounded-full" />
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

                </div>

                <p class="mt-1">
                    {{ $chirp->message }}
                </p>
            </div>
        </div>
    </div>
</div>
