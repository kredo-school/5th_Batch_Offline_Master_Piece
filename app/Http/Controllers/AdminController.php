<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 


class AdminController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index()
    {
        return view('admin.home');
    }

    public function addBook()
    {
        return view('admin.books.add');
    }

    public function guest()
    {
        // すべてのユーザーを取得
    $all_users = $this->user->with('profile')->latest()->get(); // プロファイルも一緒に取得
        
    // ビューにデータを渡す
    return view('admin.guests.guest', compact('all_users'));
        // return view('admin.guests.guest');
    }

    public function registerStore()
    {
        return view('admin.stores.register-store');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publish_date' => 'required|date',
            'description' => 'required|string',
            'genre' => 'required|string',
        ]);
    
        // 本の情報をデータベースに保存するロジックをここに追加
    
        return redirect()->route('admin.book')->with('success', 'Book added successfully.');
        // return view('admin.stores.store');
    }

    public function genre()
    {
        return view('admin.genres.genre');
    }

    public function book()
    {
        return view('admin.books.book');
    }

    public function register()
    {
        return view('admin.stores.register-store');
    }

    // 非アクティブ　ユーザー、本、店のものを分けて作る必要がある。
    public function deactivate($id)
    {
        $this->user->destroy($id);
        return redirect()->back();
    }

    // 再アクティブ
    public function activate($id){
        $this->user->onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back();
    }

    // ソフトデリートで行う感じで作った方がいいか
    // イメージはどこのデータテーブルに入っているか？
}
