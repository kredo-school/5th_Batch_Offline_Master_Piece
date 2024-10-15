<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GuestsController extends Controller
{
    public function index()
{
   // ユーザーのコメントやレポートをロード
   $all_users = User::with(['comments.thread', 'comments.reports'])->get();

   foreach ($all_users as $user) {
       // コメントごとのレポート数を計算、レポートがない場合は0を返す
       $user->thread_report_count = $user->comments->sum(function ($comment) {
           return $comment->reports->count() ?? 0; // レポートがない場合に0を返す
       });
   }

   return view('admin.users.index', compact('all_users'));
}
}
