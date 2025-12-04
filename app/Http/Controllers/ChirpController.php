<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;

use App\Models\Chirp;

use Illuminate\Database\Eloquent\Builder;

use App\Policies\ChirpPolicy;

class ChirpController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Chirp::with('user');

//        $chirps = $query->latest()->

        // maybe we can combine 'tag' query to 'q' query already
        if ($tag = $request->query('tag')) {
            $normalizedTag = strtolower($tag);
            $query->where('message', 'LIKE', "%#$normalizedTag%");
        }

        if ($search = $request->query('q')) {
            $normalized = strtolower($search);
            // https://laravel.com/docs/12.x/queries#joins
            // https://laravel.com/docs/12.x/eloquent-relationships
//            $query->join('users', 'chirps.user_id', '=', 'users.id')
//                ->where(function (Builder $q) use ($normalized) {
//                    $q->where('chirps.message', 'LIKE', "%$normalized%")
//                        ->orWhere('users.name', 'LIKE', "%$normalized%");
//
//                });

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
        }

        $chirps = $query
//            ->latest()
            ->take(50)
            ->get();
        return view('home', ['chirps' => $chirps]);
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
