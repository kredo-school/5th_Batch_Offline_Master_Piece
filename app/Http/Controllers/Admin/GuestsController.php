<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\DB; // 追加

class GuestsController extends Controller
{
    // ユーザーのリスト表示
    public function index(Request $request)
    {
        // 検索条件とソート条件の取得
        $searchTerm = $request->input('search');
        $sort = $request->input('sort', 'name'); // デフォルトは 'name'
        $order = $request->input('order', 'asc'); // デフォルトは昇順 'asc'

        // クエリの初期化
        // $query = User::withTrashed()->with(['comments.thread', 'comments.reports']); 
        // reportsをここでロード
        $query = User::withTrashed()
            ->with(['comments.thread', 'comments.reports'])
            ->where('role_id', '!=', 3); // role_idが3以外のユーザーに限定

        // 検索条件があればクエリに適用
        if (!empty($searchTerm)) {
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }
// ソート処理
if ($sort == 'report') {
    // ユーザーが持っている全てのコメントに対して、そのコメントのレポート数をカウント
    $query = $query->withCount(['comments as reports_count' => function ($query) {
        $query->withCount('reports');
    }])->orderBy('reports_count', $order);
} elseif ($sort == 'status') {
    // ソフトデリートの状態でソート（削除されていないもの優先）
    $query = $query->orderByRaw('deleted_at IS NULL ' . ($order == 'asc' ? 'ASC' : 'DESC'));
} else {
    // 通常のソート（名前など）
    $query = $query->orderBy($sort, $order);
}

// ページネーション
$all_users = $query->paginate(5);


        // 各ユーザーのレポート数を計算
        foreach ($all_users as $user) {
            $user->thread_report_count = $user->comments->sum(function ($comment) {
                return $comment->reports->count(); // reportsリレーションを経由
            });
        }

        // ビューにデータを渡す
        return view('admin.guests.guest', compact('all_users'));
    }

    // ユーザーの削除処理
    public function destroy($id)
    {
        // 指定したユーザーをソフトデリート
        $user = User::findOrFail($id);
        $user->delete();

        // 削除後にリダイレクト
        return redirect()->back();
    }

    // ユーザーの復元処理
    public function restore($id)
    {
        // ソフトデリートされたユーザーを復元
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        // 復元後にリダイレクト
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $sort = $request->input('sort', 'name');
        $order = $request->input('order', 'asc');

        // ユーザーのクエリの初期化
        // $query = User::withTrashed()->with(['comments.thread', 'comments.reports']);
        $query = User::withTrashed()
            ->with(['comments.thread', 'comments.reports'])
            ->where('role_id', '!=', 3); // role_idが3以外のユーザーに限定

        // 検索条件がある場合はそれを適用
        if (!empty($searchTerm)) {
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }

        // ソートの適用
        if ($sort == 'report') { // 変更: 'count' から 'report' に変更
            // コメントレポート数でソート
            $query = $query->withCount(['comments.reports' => function($query) {
                $query->select(DB::raw('count(*) as count')); // 変更: レポート数をカウント
            }])->orderBy('comments_reports_count', $order); // 変更: ソート条件を変更
        } elseif ($sort == 'status') {
            // ソフトデリートの状態でソート
            $query = $query->orderByRaw('deleted_at IS NULL ' . ($order == 'asc' ? 'ASC' : 'DESC'));
        } else {
            // 通常のソート（名前など）
            $query = $query->orderBy($sort, $order);
        }

        // ページネーション
        $all_users = $query->paginate(5);

        // 各ユーザーのレポート数を計算
        foreach ($all_users as $user) {
            $user->thread_report_count = $user->comments->sum(function ($comment) {
                return $comment->reports->count() ?? 0; // レポートがない場合は0を返す
            });
        }

        // ビューにデータを渡す
        return view('admin.guests.guest', compact('all_users'));
    }
}
