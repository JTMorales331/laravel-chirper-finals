<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Chirp;

class LikesController extends Controller
{
    public function store(Request $request, Chirp $chirp)
    {

        // IN ENGLISH:
        // get chirp's likes where the user_id is the current auth's id
        // if it does exist, return the back with error
        if ($chirp->likes()->where('user_id', auth()->id())->exists()){
            return back()->with('error', 'Already liked');
        }

        // create a like for the chirp
        //linked to the auth's id as user_id
        $chirp->likes()->create([
            'user_id' => auth()->id()
        ]);

        return back()->with('success', 'Liked ' . $chirp->message);
    }

    public function destroy(Request $request, Chirp $chirp)
    {
        // get the current authenticated user id
        $user = auth()->id();
        // IN ENGLISH:
        // delete the current like based on user_id
        // and the chirp id
        Like::where('user_id', $user)
            ->where('chirp_id', $chirp->id)
            ->delete();


        return back()->with('success', 'unliked!');
    }
}
