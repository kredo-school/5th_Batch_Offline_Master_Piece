<?php

namespace App\Http\Controllers;

use App\Models\genre;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGenreRequest;


class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $genre;

    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreGenreRequest $request)
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(genre $genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, genre $genre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(genre $genre)
    {
        //
    }
}
