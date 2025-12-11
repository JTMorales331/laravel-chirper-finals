<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;

use App\Models\Chirp;

use Illuminate\Database\Eloquent\Builder;

use App\Policies\ChirpPolicy;

use Illuminate\Support\Facades\Cache;

class ChirpController extends Controller
{
    use AuthorizesRequests;

    // because I'm thinking of having separate index controllers
    private function handleSearch(Request $request)
    {
        $query = Chirp::with('user');

        // maybe we can combine 'tag' query to 'q' query already
        if ($tag = $request->query('tag')) {
            $normalizedTag = strtolower($tag);
            $query->where(function (Builder $q) use ($normalizedTag) {
                // NOTE: have space
                $q->where('message', 'LIKE', "% $normalizedTag %") // a hashtag is in the middle of the message
                ->orWhere('message', 'LIKE', "% $normalizedTag") // message ends with the hashtag
                ->orWhere('message', 'LIKE', "$normalizedTag %") // message starts with a hashtag
                ->orWhere('message', '=', $normalizedTag); // message is just a hashtag
            });
        }

        if ($search = $request->query('q')) {
            $normalized = strtolower($search);


            // suggestion: updatable cache to avoid looking around the DB

            $queryArray = explode(" ", $normalized);
            sort($queryArray);
            $cacheKey = implode("_", $queryArray);
//            var_dump($cacheKey);

            // get cache if it still exists
            $cache = Cache::get($cacheKey);

            if ($cache) {
//                var_dump($cache);
                return $cache;
            }

//            $retrievedCachedQuery = Cache::get($normalized)

            // https://laravel.com/docs/12.x/queries#joins
            // https://laravel.com/docs/12.x/eloquent-relationships
            // a bit more Eloquent or something
            // how to know if we can do WhereHas:
            // check if what we want to WhereHas with (user) is related to
            // the current model we are querying with og (chirp)
            $query->where(function (Builder $q) use ($normalized) {
                $q->where('message', 'LIKE', "%$normalized%")
                    ->orWhereHas("user", function (Builder $q2) use ($normalized) {
                        $q2->where('name', 'LIKE', "%$normalized%");
                    });
            });

            $output = $query->latest()->take(50)->get();
            if ($output) {
                Cache::put($cacheKey, $output, 30);
            }

        }

        return $query->latest()->take(50)->get();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


//        $chirps = $query
////            ->latest()
//            ->take(50)
//            ->get();

        $chirps = $this->handleSearch($request);

        return view('home', ['chirps' => $chirps]);
    }

    public function search(Request $request)
    {
        $chirps = $this->handleSearch($request);

        $keyword = $request->query('q');
        $tag = $request->query('tag');
//        var_dump($keyword);
//        dump($tag);

        return view('search', ['chirps' => $chirps, 'keyword' => $keyword, 'tag' => $tag]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ], [
            'message.required' => 'Please write something to chirp!',
            'message.max' => 'Chirp must be 255 characters or less.'
        ]);

//        \App\Models\Chirp::create([
//            'message' => $validated['message'],
//            'user_id' =>null
//        ]);

        auth()->user()->chirps()->create($validated);

        return redirect('/')->with('success', 'Your chirp has been posted!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        $this->authorize('update', $chirp);
        return view('chirps.edit', compact('chirp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        $this->authorize('update', $chirp);
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ], [
            'message.required' => 'Please write something to chirp!',
            'message.max' => 'Chirp must be 255 characters or less.'
        ]);

        $chirp->update($validated);

        return redirect('/')->with('success', 'Your chirp has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);
        $chirp->delete();

        return redirect('/')->with('success', 'Your chirp has been deleted!!');
    }
}
