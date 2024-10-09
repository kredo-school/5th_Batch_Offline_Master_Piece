<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Genre;
use App\Models\Comment;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\ThreadRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ThreadController extends Controller
{
    private $thread;
    private $genre;
    private $comment;
    public function __construct(Thread $thread, Genre $genre, Comment $comment)
    {
        $this->thread = $thread;
        $this->genre = $genre;
        $this->comment = $comment;
    }
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        return view('thread.home');
    }

    public function content($thread)
    {
        return view('thread.content')->with(compact('thread'));
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

            $thread = $this->thread->create(array_merge($validated,[
                'user_id' => Auth::id(),
            ]));

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
    public function show(Thread $thread)
    {
        //
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
    public function destroy(Thread $thread)
    {
        //
    }
}
