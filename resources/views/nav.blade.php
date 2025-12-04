<nav class="navbar bg-base-100 shadow-sm">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"/>
                </svg>
            </div>
            <ul
                tabindex="-1"
                class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                @auth
                    <li>
                        <span class="text-sm">{{ auth()->user()->name }}</span>
                    </li>
                    <li>
                        <form method="POST"
                              class="inline-flex items-start text-xs font-bold border-b-2 hover:opacity-70 active:opacity-50 transition duration-300 border-transparent"
                              action={{"logout"}}>
                            @csrf
                            <button type="submit" class="btn btn-ghost btn-sm">Logout</button>
                        </form>
                    </li>
                    <li>
                        <a href="/bookmarks"
                           class="inline-flex items-start text-xs font-bold border-b-2 hover:opacity-70 active:opacity-50 transition duration-300 {{ request()->routeIs('bookmarks') ? "border-neutral-900" : "border-transparent" }}"
                        >
                            Bookmarks
                        </a>
                    </li>
                @else
                    <li><a href="/login" class="btn btn-ghost btn-sm">Sign In</a></li>
                    <li><a href="{{ route('register') }}" class="btn btn-primary btn-sm">Sign Up</a></li>

                @endauth
            </ul>
        </div>


        <a href="/" class="btn btn-ghost text-xl">🐦 Chirper</a>
        <a href="/bookmarks"
           class="hidden lg:inline-flex items-center text-xs font-bold border-b-2 hover:opacity-70 active:opacity-50 transition duration-300 {{ request()->routeIs('bookmarks') ? "border-neutral-900" : "border-transparent" }}"
        >
            Bookmarks
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <form class="join w-[100%] border" method="GET" action={{ "search" }}>
            <label for="query" class="input validator join-item w-[100%]">
                <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g
                        stroke-linejoin="round"
                        stroke-linecap="round"
                        stroke-width="2.5"
                        fill="none"
                        stroke="currentColor"
                    >
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </g>
                </svg>
                <input id="query" name="q" type="text" class="w-full" placeholder="Search"/>
            </label>
            <button type="submit" class="btn btn-neutral join-item">Search</button>
        </form>

    </div>
    <div class="navbar-end gap-2">
        <div class="max-lg:hidden">
            @auth
                {{--            Show this if we are authenticated--}}
                <span class="text-sm">{{ auth()->user()->name }}</span>
                <form method="POST" action={{"logout"}} class="inline">
                    @csrf
                    <button type="submit" class="btn btn-ghost btn-sm">Logout</button>
                </form>
            @else
                {{--            else, show these--}}
                <a href="/login" class="btn btn-ghost btn-sm">Sign In</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Sign Up</a>
            @endauth

        </div>
        <form class="join w-[100%] lg:hidden" method="GET" action={{ "search" }}>
            <label for="query" class="input validator join-item w-[100%]">
                <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g
                        stroke-linejoin="round"
                        stroke-linecap="round"
                        stroke-width="2.5"
                        fill="none"
                        stroke="currentColor"
                    >
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </g>
                </svg>
                <input id="query" name="q" type="text" class="w-full" placeholder="Search"/>
            </label>
            <button type="submit" class="btn btn-neutral join-item">
                <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g
                        stroke-linejoin="round"
                        stroke-linecap="round"
                        stroke-width="2.5"
                        fill="none"
                        stroke="currentColor"
                    >
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.3-4.3"></path>
                    </g>
                </svg>
            </button>
        </form>
    </div>
</nav>
