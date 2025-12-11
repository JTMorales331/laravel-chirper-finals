<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use App\Models\Chirp;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class BookmarksController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */

    private function cacheKey(){
        return "bookmarks_of_id_" . auth()->id();
    }

    public function index(Request $request, Chirp $chirp)
    {

        $cache = Cache::get($this->cacheKey());
        if ($cache) {
//            var_dump($cache);
//            dd($cache);
//            $chirps = Chirp::hydrate($cache);
//            dd($chirps);
            return view('bookmarks', ['chirps' => $cache]);
        }

        // we get the current auth's user's bookmarks along with the chirp.user's models
        $bookmarks = auth()->user()->bookmarks()->with('chirp.user')->latest()->get();

        // we "pluc" the chirp models from the bookmarks collection
        $chirps = $bookmarks->pluck('chirp')->filter();

        // put the cache in cache key
        Cache::put($this->cacheKey(), $chirps, 10);
//        dd($chirps);

        return view('bookmarks', ['chirps' => $chirps]);
    }

    public function store(Request $request, Chirp $chirp)
    {
        // check if its already bookmarked
        if ($chirp->bookmarks()->where('user_id', auth()->id())->exists()) {
            return back()->with('error', 'Already bookmarked');
        }

        $chirp->bookmarks()->create([
            'user_id' => auth()->id(),
            'chirp_id' => $chirp->id,
        ]);

        // cache is now stale
        Cache::forget($this->cacheKey());

//        return back()->with('success', 'Bookmarked' . $chirp->message);
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Chirp $chirp)
    {
        $user = auth()->id();

//        Log::info('This is working: ' . $chirp->id);

        Bookmark::where('user_id', $user)
            ->where('chirp_id', $chirp->id)
            ->delete();

        // cache is now stale
        Cache::forget($this->cacheKey());

        return response()->json(['success' => true]);
    }
}
