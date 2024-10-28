<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{
    private $like;

    public function __construct(Like $like)
    {
        $this->like = $like;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store($review_id)
    {
        //
        $this->like->guest_id = Auth::user()->id;
        $this->like->review_id = $review_id;

        $this->like->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($review_id)
    {
        //
        $this->like->where('guest_id',Auth::user()->id)
                        ->where('review_id',$review_id)
                        ->delete();

        return redirect()->back();
    }
}
