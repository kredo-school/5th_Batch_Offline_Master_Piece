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

    public function index()
    {
        $genres = $this->genre->withTrashed()->latest()->paginate(5);

        return view('admin.genres.genre',compact('genres'));

    }

    public function create(StoreGenreRequest $request)
    {
        //
        $this->genre->create($request->validated());

        return redirect()->back();

    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        $genres = $this->genre->where('name', 'LIKE', "%{$searchTerm}%")->paginate(5);

        return view('admin.genres.genre', compact('genres'));
    }

    public function destroy($id)
    {
        $this->genre->destroy($id);

        return redirect()->back();


    }

    public function restore($id) {
        $this->genre->onlyTrashed()->findOrFail($id)->restore();
        # ->onlyTrashed(): Filters only soft deleted user records.
        # ->restore(): Restores the soft deleted user record.

        return redirect()->back();
    }
}
