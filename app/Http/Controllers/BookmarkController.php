<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookmarkController extends Controller
{
    private $bookmark;
    /**
     * Display a listing of the resource.
     */

    public function __construct(Bookmark $bookmark){
        $this->bookmark = $bookmark;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($book_id)
    {
        //
        $this->bookmark->guest_id = Auth::user()->id;
        $this->bookmark->book_id = $book_id;

        $this->bookmark->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($book_id)
    {
        //
        $this->bookmark->where('guest_id',Auth::user()->id)
                        ->where('book_id',$book_id)
                        ->delete();

        return redirect()->back();
    }
}
