<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\genre;
use App\Http\Requests\StoreGenreRequest;



class GenresController extends Controller
{
    //

    private $genre;

    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    public function create(StoreGenreRequest $request)
    {
        //
        $this->genre->create($request->validated());

        return redirect()->back();

    }
}
