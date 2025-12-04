<!DOCTYPE html>
<html lang="en" data-theme="lofi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{--    <meta name="csrf-token" content="{{ csrf_token() }}" />--}}
    <title>{{ isset($title) ? $title . ' - Chirper' : 'Chirper' }}</title>
    <link rel="preconnect" href="<https://fonts.bunny.net>">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-base-200 font-sans">

<div class="drawer">
    <input id="my-drawer-2" type="checkbox" class="drawer-toggle"/>
    <div class="drawer-content flex flex-col">
        <!-- Navbar -->
        <nav class="navbar bg-base-100 w-full">
            <div class="navbar-start">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-2" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            class="inline-block h-6 w-6 stroke-current"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            ></path>
                        </svg>
                    </label>
                </div>
                <a href="/" class="btn btn-ghost text-xl">🐦 Chirper</a>
                <a href="/bookmarks"
                   class="hidden lg:inline-flex items-center text-xs font-bold border-b-2 hover:opacity-70 active:opacity-50 transition duration-300 {{ request()->routeIs('bookmarks') ? "border-neutral-900" : "border-transparent" }}"
                >
                    Bookmarks
                </a>
            </div>
            <div class="navbar-center hidden lg:flex justify-center w-lg">
                <form class="join w-[80%]" method="GET" action={{ "search" }}>
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
            </div>
        </nav>
    </div>
    <div class="drawer-side px-0">
        <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
        <div class="menu bg-base-200 min-h-full w-80 py-4 px-0">
            <!-- Sidebar content here -->
            @auth
                {{--            Show this if we are authenticated--}}
                <span class="text-lg font-bold px-4 mb-3">{{ auth()->user()->name }}</span>
                <form class="join w-[100%] px-4 lg:hidden mx-auto" method="GET" action={{ "search" }}>
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

                <ul class="w-full flex flex-col mt-4">
                    <!-- Logout as full-width button -->
                    <li class="w-full">
                    <li><a href="{{ route('bookmarks') }}"
                           class="w-full text-start font-bold px-4 py-5 {{ request()->routeIs("bookmarks") ? 'bg-neutral-900 text-neutral-100' : 'hover:bg-neutral-400 active:bg-neutral-700 transition text-neutral-900 hover:text-neutral-100 active:text-neutral-100' }}">
                            Bookmarks</a></li>


                    <li class="w-full">
                        <form method="POST" class="p-0 m-0 w-full" action="{{"logout"}}">
                            @csrf
                            <button
                                type="submit"
                                class="w-full font-bold text-start px-4 py-5 hover:bg-neutral-400 active:bg-neutral-700 transition hover:next-neutral-100 active:text-neutral-100">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            @else
                <span class="text-lg font-bold px-4 mb-3">Guest</span>
                <form class="join w-[100%] px-4 lg:hidden mx-auto" method="GET" action={{ "search" }}>
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
                {{--            else, show these--}}
                <ul class="w-full [&>li]:w-full flex flex-col mt-4 text-neutral-900">
                    <li><a href="/login"
                           class="w-full text-start font-bold px-4 py-5 {{ request()->routeIs("login") ? 'bg-neutral-900 text-neutral-100' : 'hover:bg-neutral-400 active:bg-neutral-700 transition text-neutral-900 hover:text-neutral-100 active:text-neutral-100' }}">Sign
                            In</a></li>
                    <li><a href="{{ route('register') }}"
                           class="w-full text-start font-bold px-4 py-5 {{ request()->routeIs("register") ? 'bg-neutral-900 text-neutral-100' : 'hover:bg-neutral-400 active:bg-neutral-700 transition text-neutral-900 hover:text-neutral-100 active:text-neutral-100' }}">
                            Sign Up</a></li>

                </ul>
            @endauth
        </div>
    </div>
</div>

@if (session('success'))
    <div class="toast toast-top toast-center">
        <div class="alert alert-success animate-fade-out">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ session('success') }}</span>
        </div>
    </div>
@endif

<main class="flex-1 container mx-auto px-4 py-8">
    {{ $slot }}
</main>

<footer class="footer footer-center p-5 bg-base-300 text-base-content text-xs">
    <div>
        <p>© 2025 Chirper - Built with Laravel and ❤️</p>
    </div>
</footer>
</body>

</html>
