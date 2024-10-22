<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Thread;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\ThreadCommentRequest;

class CommentController extends Controller
{
    private $comment;
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    /**
     * Display a listing of the resource.
     */

    public function sort(Request $request, $user_id)
    {
        // 指定されたユーザーを取得
        $user = User::findOrFail($user_id);

        // ソートのオプションを取得
        $sortOption = $request->input('sort');

        // コメントの基本クエリ
        $commentsQuery = Comment::where('guest_id', $user->id);

        // ソートオプションに応じた並び替え
        if ($sortOption === 'latest') {
            // 最新順
            $commentsQuery->orderBy('created_at', 'desc');
        } elseif ($sortOption === 'oldest') {
            // 古い順
            $commentsQuery->orderBy('created_at', 'asc');
        } elseif ($sortOption === 'reported') {
            // レポート数順：レポート数をカウントして多い順に並び替え
            $commentsQuery->withCount('reports')  // reportsテーブルとのリレーションを使う
                ->orderBy('reports_count', 'desc');
        }

        // 最終的なコメントの結果を取得
        $comments = $commentsQuery->get();

        // ビューにデータを渡す
        return view('users.guests.profile.comment', compact('user', 'comments'));
    }

    public function addComment(ThreadCommentRequest $request, Thread $thread)
    {
        $validated = $request->validated();

        $this->comment->body = $validated['body'];
        $this->comment->thread_id = $thread->id;
        $this->comment->guest_id = Auth::id();
        if(!empty($validated['image'])){
            $this->comment->image = 'data:image/'.$validated['image']->extension().';base64,'.base64_encode(file_get_contents($validated['image']));
        }
        $this->comment->save();

        $latestPage = ceil(count($thread->comments) / 100);

        $url = url()->route('thread.content', ['thread' => $thread, 'page'  => $latestPage]). '#comment-' .count($thread->comments);
        return redirect($url);
    }

    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $this->comment->destroy($id);

        return redirect()->back();
    }
}
