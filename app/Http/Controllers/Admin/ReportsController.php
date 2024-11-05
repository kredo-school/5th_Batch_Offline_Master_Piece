<?php

// ReportsController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Reason;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\SoftDeletes;


class ReportsController extends Controller
{
    use SoftDeletes;

    private $report;
    private $reason;

    public function __construct(Report $report, Reason $reason)
    {
        $this->report = $report;
        $this->reason = $reason;
    }

    public function index(Request $request)
    {
        $sort = $request->input('sort', 'created_at'); // デフォルトは 'created_at'
        $order = $request->input('order', 'desc'); // デフォルトは降順 'desc'

        // リレーションのプリロード（Reasonモデルに対してwithTrashed()を追加）
        $query = $this->report->with(['reason' => function ($query) {
            $query->withTrashed(); // ソフトデリートされたレコードも含める
        }, 'comment', 'user']);

        if ($sort === 'reason') {
            // サブクエリを使用して'reason'でソート
            $query = $query->orderBy(
                Reason::select('reason')
                    ->whereColumn('reasons.id', 'reports.reason_id')
                    ->withTrashed(), // ソフトデリートされたレコードも含める
                $order
            );
        } elseif ($sort === 'name') {
            // サブクエリを使用して'name'でソート
            $query = $query->orderBy(
                User::select('name')
                    ->whereColumn('users.id', 'reports.guest_id'),
                $order
            );
        } elseif ($sort === 'comment') {
            // サブクエリを使用して'comment'でソート
            $query = $query->orderBy(
                Comment::select('body')
                    ->whereColumn('comments.id', 'reports.comment_id'),
                $order
            );
        } else {
            $query = $query->orderBy($sort, $order);
        }

        $reports = $query->paginate(5);
        $all_reasons = $this->reason->get(); // 理由一覧の取得もソフトデリート含む

        return view('admin.reports.report', compact('reports', 'all_reasons'));
    }


    public function search(Request $request)
    {
        $query = $this->report->newQuery()->with(['reason', 'comment', 'user']); // リレーションのプリロード
        $searchTerm = $request->input('search');
        $sort = $request->input('sort', 'created_at');
        $order = $request->input('order', 'desc');

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
        $all_reasons = $this->reason->all();

        return view('admin.reports.report', compact('reports', 'all_reasons'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'string|max:255'
        ]);

        $this->reason->reason = $request->reason;
        $this->reason->save();

        return redirect()->back();
    }

    public function reasonDestroy(Reason $reason)
    {
        $reason->delete();
        return redirect()->back();
    }
}
