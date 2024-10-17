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

    public function index(Request $request)
    {
        $query = $this->genre->withTrashed();  // クエリビルダーの初期化

        // ソートの取得
        $sort = $request->input('sort', 'name'); // デフォルトは 'name'
        $order = $request->input('order', 'asc'); // デフォルトは昇順 'asc'
    
        // 'count' でソートする場合は特殊処理
        if ($sort == 'count') {
            $query = $query->withCount('genre_book')->orderBy('genre_book_count', $order); // 'genre_book_count' は関連のカウント
        } elseif ($sort == 'status') {
            // ソフトデリートの状態でソート（削除されていないものを優先）
            $query = $query->orderByRaw('deleted_at IS NULL ' . ($order == 'asc' ? 'ASC' : 'DESC'));
        } else {
            $query = $query->orderBy($sort, $order);
        }
    
        $genres = $query->paginate(5);  // ページネーション
    
        return view('admin.genres.genre', compact('genres'));
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
        $sort = $request->input('sort', 'name');
        $order = $request->input('order', 'asc');
    
        $query = $this->genre->withTrashed(); // クエリの初期化
        
        // 検索条件がある場合はそれを適用
        if (!empty($searchTerm)) {
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }
    
        // ソートの適用
        if ($sort == 'count') {
            $query = $query->withCount('genre_book')->orderBy('genre_book_count', $order); 
        } elseif ($sort == 'status') {
            $query = $query->orderByRaw('deleted_at IS NULL ' . ($order == 'asc' ? 'ASC' : 'DESC'));
        } else {
            $query = $query->orderBy($sort, $order);
        }
    
        $genres = $query->paginate(5);
    
        return view('admin.genres.genre', compact('genres'));
    }
    

    public function destroy($id)
    {
        $this->genre->destroy($id);

        return redirect()->back();


    }

    public function restore($id) {
        
        
        $this->genre->onlyTrashed()->findOrFail($id)->restore();

        // # ->onlyTrashed(): Filters only soft deleted user records.
        // # ->restore(): Restores the soft deleted user record.

        return redirect()->back();
    }
}
