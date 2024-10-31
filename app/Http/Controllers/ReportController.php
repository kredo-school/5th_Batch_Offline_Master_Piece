<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Comment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private $report;
    private $comment;
    public function __construct(Report $report, Comment $comment)
    {
        $this->report = $report;
        $this->comment = $comment;
    }

    public function report(Request $request, Comment $comment)
    {
        $request->validate([
            'spam' => 'required'
        ]);

        $this->report->comment_id = $comment->id;
        $this->report->guest_id = $comment->user->id;
        $this->report->reason_id = $request->spam;
        $this->report->save();

        return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     */
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
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
