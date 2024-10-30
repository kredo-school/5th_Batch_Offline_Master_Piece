<?php

// ReportsController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Reason;
use App\Models\User;
use App\Models\Comment;

class ReportsController extends Controller
{
    private $report;

    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    public function index(Request $request)
    {
        $sort = $request->input('sort', 'created_at'); // デフォルトは 'created_at'
        $order = $request->input('order', 'asc'); // デフォルトは昇順 'asc'

        // リレーションのプリロード
        $query = $this->report->with(['reason', 'comment', 'user']);

        if ($sort === 'reason') {
            // サブクエリを使用して'reason'でソート
            $query = $query->with('reason')
                ->orderBy(
                    Reason::select('reason')
                        ->whereColumn('reasons.id', 'reports.reason_id'),
                    $order
                );
        } elseif ($sort === 'name') {
            // サブクエリを使用して'name'でソート
            $query = $query->with('user')
                ->orderBy(
                    User::select('name')
                        ->whereColumn('users.id', 'reports.guest_id'),
                    $order
                );
        } elseif ($sort === 'comment') {
            // サブクエリを使用して'name'でソート
            $query = $query->with('comment')
                ->orderBy(
                    Comment::select('body')
                        ->whereColumn('comments.id', 'reports.comment_id'),
                    $order
                );
        } else {
            $query = $query->orderBy($sort, $order);
        }

        $reports = $query->paginate(5);

        return view('admin.reports.report', compact('reports'));
    }

    public function search(Request $request)
    {
        $query = $this->report->newQuery()->with(['reason', 'comment', 'user']); // リレーションのプリロード
        $searchTerm = $request->input('search');
        $sort = $request->input('sort', 'created_at');
        $order = $request->input('order', 'asc');

        // 検索条件の適用
        if (!empty($searchTerm)) {
            $query->whereHas('user', function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%");
            })
            ->orWhereHas('reason', function ($q) use ($searchTerm) {
                $q->where('reason', 'LIKE', "%{$searchTerm}%");
            })
            ->orWhereHas('comment', function ($q) use ($searchTerm) {
                $q->where('body', 'LIKE', "%{$searchTerm}%");
            });
        }

        // ソートの適用
        if ($sort === 'reason') {
            // サブクエリを使用して'reason'でソート
            $query = $query->with('reason')
                ->orderBy(
                    Reason::select('reason')
                        ->whereColumn('reasons.id', 'reports.reason_id'),
                    $order
                );
        } elseif ($sort === 'name') {
            // サブクエリを使用して'name'でソート
            $query = $query->with('user')
                ->orderBy(
                    User::select('name')
                        ->whereColumn('users.id', 'reports.guest_id'),
                    $order
                );
        } elseif ($sort === 'comment') {
            // サブクエリを使用して'name'でソート
            $query = $query->with('comment')
                ->orderBy(
                    Comment::select('body')
                        ->whereColumn('comments.id', 'reports.comment_id'),
                    $order
                );
        } else {
            $query = $query->orderBy($sort, $order);
        }

        $reports = $query->paginate(5);

        return view('admin.reports.report', compact('reports'));
    }
}
