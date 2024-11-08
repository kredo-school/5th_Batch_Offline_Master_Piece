<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\genre;
use App\Models\Comment;
use App\Models\Reason;
use App\Models\ThreadGenre;
use App\Models\ThreadBookmark;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ThreadRequest;
use App\Http\Requests\ThreadSearchRequest;
use App\Http\Requests\ThreadCommentRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ThreadController extends Controller
{
    private $thread;
    private $genre;
    private $comment;
    private $thread_bookmark;
    public function __construct(Thread $thread, genre $genre, Comment $comment, ThreadBookmark $thread_bookmark)
    {
        $this->thread = $thread;
        $this->genre = $genre;
        $this->comment = $comment;
        $this->thread_bookmark = $thread_bookmark;
    }
    /**
     * Display a listing of the resource.
     */
    public function home(ThreadSearchRequest $request)
    {
        // genre
        $genre_id = $request->genre_id;

        if($request->bookmark == 'true'){
            $thread_ids = $this->thread_bookmark->where('guest_id', Auth::id())->pluck('thread_id');
            $threads = $this->thread->whereIn('id', $thread_ids)->latest()->get();
            $search_threads = collect();
        }else{
            if($genre_id){
                $thread_ids = ThreadGenre::where('genre_id', $genre_id)->pluck('thread_id');

                if($thread_ids){
                    $threads = $this->thread->whereIn('id', $thread_ids)->latest()->get();
                }
            }else{
                $threads = $this->thread->latest()->get();
            }


            // search
            $validated = $request->validated();
            if(isset($validated['search'])){
                $search_threads = $this->thread->where('title', 'like', '%'.$validated['search'].'%')->get();
            }else{
                $search_threads = collect();
            }
        }

        // other
        $all_comments =  $this->comment->latest()->get();
        $all_genres =  $this->genre->all();


        return view('thread.home')->with(compact('threads', 'all_comments', 'all_genres', 'search_threads', 'genre_id', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $all_genres = $this->genre->all();
        return view('thread.create')->with(compact('all_genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ThreadRequest $request)
    {
        DB::beginTransaction();

        try
        {
            $validated = $request->validated();
            $validated['user_id'] = Auth::id();

            $thread = $this->thread->create($validated);


            $this->comment->body = $validated['body'];
            $this->comment->thread_id = $thread->id;
            $this->comment->guest_id = Auth::id();
            if(!empty($validated['image'])){
                $this->comment->image = 'data:image/'.$validated['image']->extension().';base64,'.base64_encode(file_get_contents($validated['image']));
            }
            $this->comment->save();


            if(!empty($validated['genre'])){
                $genre_thread = [];
                foreach($validated['genre'] as $genre_id):
                    $genre_thread[] = ['genre_id' => $genre_id];
                endforeach;
                $thread->genre_threads()->createMany($genre_thread);
            }


            DB::commit();
            return redirect()->route('thread.content', compact('thread'));

        }catch(\Exception $e){
            DB::rollBack();

			Log::error('Transaction failed: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function content(Request $request, Thread $thread)
    {
        $genres = $thread->genre_threads()->get();
        $comments = $thread->comments()->withTrashed()->paginate(100);
        $all_genres = $this->genre->all();
        $latestPage = ceil(count($thread->comments) / 100);
        $reasons = Reason::all();

        return view('thread.content')->with(compact('thread', 'genres', 'comments', 'all_genres', 'latestPage', 'request', 'reasons'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroyThread(Thread $thread)
    {
        $thread->delete();
        return redirect()->route('thread.home');
    }

    public function bookmark(Thread $thread)
    {
        $this->thread_bookmark->guest_id = Auth::id();
        $this->thread_bookmark->thread_id = $thread->id;
        $this->thread_bookmark->save();

        return redirect()->back();
    }

    public function bookmarkDestroy($thread_id)
    {
        $this->thread_bookmark->where('guest_id', Auth::id())
                                    ->where('thread_id', $thread_id)
                                    ->delete();

        return redirect()->back();
    }
}
