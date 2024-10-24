<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // クラスのインポート


class StoresController extends Controller
{
    // public function show(Request $request)
    // {
    //     $searchTerm = $request->input('search');
    //     $sort = $request->input('sort', 'name');
    //     $order = $request->input('order', 'asc');
    //     $selectedPrefecture = $request->input('address');

    //     $query = User::with(['profile'])->withTrashed();
        
    //     if (!empty($searchTerm)) {
    //         $query->where(function ($q) use ($searchTerm) {
    //             $q->where('name', 'LIKE', "%{$searchTerm}%")
    //               ->orWhereHas('profile', function ($query) use ($searchTerm) {
    //                   $query->where('phone_number', 'LIKE', "%{$searchTerm}%")
    //                         ->orWhere('address', 'LIKE', "%{$searchTerm}%");
    //               });
    //         });
    //     }

    //     $query->where('role_id', 3);

    //     // ソートの適用
    //     if ($sort === 'status') {
    //         $query->orderByRaw('CASE WHEN deleted_at IS NULL THEN 0 ELSE 1 END ' . $order);
    //     } elseif ($sort === 'phone_number') {
    //         $query->orderBy('profile.phone_number', $order);
    //     } elseif ($sort === 'address') {
    //         $query->orderBy('profile.address', $order);
    //     } else {
    //         $query->orderBy($sort, $order);
    //     }

    //     // 都道府県のフィルタリング
    //     if (!empty($selectedPrefecture)) {
    //         $query->whereHas('profile', function ($q) use ($selectedPrefecture) {
    //             $q->where('address', 'LIKE', "%{$selectedPrefecture}%");
    //         });
    //     }

    //     $stores = $query->paginate(5);

    //     // 都道府県データ（必要に応じて使用）
    //     $prefectures = ['Hokkaido', 'Aomori', 'Iwate', 'Miyagi', 'Akita', 'Yamagata', 'Fukushima', 'Ibaraki', 'Tochigi', 'Gunma', 'Saitama', 'Chiba', 'Tokyo', 'Kanagawa', 'Niigata', 'Toyama', 'Ishikawa', 'Fukui', 'Yamanashi', 'Nagano', 'Gifu', 'Shizuoka', 'Aichi', 'Mie', 'Shiga', 'Kyoto', 'Osaka', 'Hyogo', 'Nara', 'Wakayama', 'Tottori', 'Shimane', 'Okayama', 'Hiroshima', 'Yamaguchi', 'Tokushima', 'Kagawa', 'Ehime', 'Kochi', 'Fukuoka', 'Saga', 'Nagasaki', 'Kumamoto', 'Oita', 'Miyazaki', 'Kagoshima', 'Okinawa'];

    //     return view('admin.stores.store', [
    //         'stores' => $stores,
    //         'searchTerm' => $searchTerm,
    //         'prefectures' => $prefectures,
    //     ]);
    public function show(Request $request)
{
    $searchTerm = $request->input('search');
    $sort = $request->input('sort', 'name');
    $order = $request->input('order', 'asc');
    $selectedPrefecture = $request->input('address');

    $query = User::with(['profile'])->withTrashed()
                  ->where('role_id', 3); // role_idが3のユーザーをフィルタリング

    if (!empty($searchTerm)) {
        $query->where(function ($q) use ($searchTerm) {
            $q->where('name', 'LIKE', "%{$searchTerm}%")
              ->orWhereHas('profile', function ($query) use ($searchTerm) {
                  $query->where('phone_number', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('address', 'LIKE', "%{$searchTerm}%");
              });
        });
    }

    // 都道府県のフィルタリング
    if (!empty($selectedPrefecture)) {
        $query->whereHas('profile', function ($q) use ($selectedPrefecture) {
            $q->where('address', 'LIKE', "%{$selectedPrefecture}%");
        });
    }

    // ソートの適用
    if ($sort === 'status') {
        $query->orderByRaw('CASE WHEN deleted_at IS NULL THEN 0 ELSE 1 END ' . $order);
    } elseif ($sort === 'phone_number') {
        $query->join('profiles', 'profiles.user_id', '=', 'users.id') // profileテーブルと結合
              ->orderBy('profiles.phone_number', $order);
    } elseif ($sort === 'address') {
        $query->join('profiles', 'profiles.user_id', '=', 'users.id') // profileテーブルと結合
              ->orderBy('profiles.address', $order); // addressでのソート
    } else {
        $query->orderBy($sort, $order);
    }

    // ページネーション
    $stores = $query->paginate(5);

    // 都道府県データ
    $prefectures = ['Hokkaido', 'Aomori', 'Iwate', 'Miyagi', 'Akita', 'Yamagata', 'Fukushima', 'Ibaraki', 'Tochigi', 'Gunma', 'Saitama', 'Chiba', 'Tokyo', 'Kanagawa', 'Niigata', 'Toyama', 'Ishikawa', 'Fukui', 'Yamanashi', 'Nagano', 'Gifu', 'Shizuoka', 'Aichi', 'Mie', 'Shiga', 'Kyoto', 'Osaka', 'Hyogo', 'Nara', 'Wakayama', 'Tottori', 'Shimane', 'Okayama', 'Hiroshima', 'Yamaguchi', 'Tokushima', 'Kagawa', 'Ehime', 'Kochi', 'Fukuoka', 'Saga', 'Nagasaki', 'Kumamoto', 'Oita', 'Miyazaki', 'Kagoshima', 'Okinawa'];

    // ビューにデータを渡す
    return view('admin.stores.store', [
        'stores' => $stores,
        'searchTerm' => $searchTerm,
        'prefectures' => $prefectures,
    ]);
}


    

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $sort = $request->input('sort', 'name'); // デフォルトのソートは名前に設定
        $order = $request->input('order', 'asc');

        // クエリの初期化
        $query = User::with(['profile'])->withTrashed(); // 削除されたユーザーも含める

        // 検索条件があればクエリに適用
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                  ->orWhereHas('profile', function ($query) use ($searchTerm) {
                      $query->where('phone_number', 'LIKE', "%{$searchTerm}%")
                            ->orWhere('email', 'LIKE', "%{$searchTerm}%");
                  });
            });
        }

        // role_idが3のユーザー（ストア）をフィルタリング
        $query->where('role_id', 3);

        // ソートの適用
        if ($sort === 'status') {
            $query->orderBy('status', $order);
        } elseif ($sort === 'phone_number') {
            $query->orderBy('profile.phone_number', $order);
        } elseif ($sort === 'address') {
            $query->orderBy('profile.address', $order);
        } else {
            $query->orderBy($sort, $order);
        }

        // ページネーション
        $stores = $query->paginate(5);

        // 都道府県データ（必要に応じて使用）
        $prefectures = ['Hokkaido', 'Aomori', 'Iwate', 'Miyagi', 'Akita', 'Yamagata', 'Fukushima', 'Ibaraki', 'Tochigi', 'Gunma', 'Saitama', 'Chiba', 'Tokyo', 'Kanagawa', 'Niigata', 'Toyama', 'Ishikawa', 'Fukui', 'Yamanashi', 'Nagano', 'Gifu', 'Shizuoka', 'Aichi', 'Mie', 'Shiga', 'Kyoto', 'Osaka', 'Hyogo', 'Nara', 'Wakayama', 'Tottori', 'Shimane', 'Okayama', 'Hiroshima', 'Yamaguchi', 'Tokushima', 'Kagawa', 'Ehime', 'Kochi', 'Fukuoka', 'Saga', 'Nagasaki', 'Kumamoto', 'Oita', 'Miyazaki', 'Kagoshima', 'Okinawa'];

        // ビューにデータを渡す
        return view('admin.stores.store', [
            'stores' => $stores,
            'searchTerm' => $searchTerm,
            'prefectures' => $prefectures,
        ]);
    }

    public function destroy($id)
    {
        $store = User::withTrashed()->find($id); // ソフトデリートを含めてストアを取得

        if ($store) {
            $store->delete(); // ソフトデリート
            return redirect()->route('admin.stores.show')->with('success', 'Store deleted successfully.');
        }

        return redirect()->route('admin.stores.show')->with('error', 'Store not found.');
    }

    public function restore($id)
    {
        $store = User::withTrashed()->find($id); // ソフトデリートされたストアも取得

        if ($store) {
            $store->restore(); // 復元
            return redirect()->route('admin.stores.show')->with('success', 'Store restored successfully.');
        }

        return redirect()->route('admin.stores.show')->with('error', 'Store not found.');
    }
}
