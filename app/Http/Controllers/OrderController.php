<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBooklistRequest;
use Illuminate\Http\Request;
use App\Models\StoreOrder;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StoreInventoryRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    private $order;

    public function __construct(StoreOrder $storeOrder)
    {
        $this->order = $storeOrder;
    }

    public function NewConfirmShow(){
        $bookinfo = $this->order
    ->join('author_books', 'author_books.book_id', '=', 'store_orders.book_id') // もしstore_ordersの中にbook_idがあるなら
    ->join('books', 'books.id', '=', 'author_books.book_id') // こちらを正しいテーブル名に
    ->join('authors', 'author_books.author_id', '=', 'authors.id')
    ->select('books.*', 'authors.name as author_name') // 必要なカラムを選択
    ->get();

    // dd($bookinfo);
        return view('users.store.books.new-order-confirm')->with(compact('bookinfo'));
    }

    public function inventoryOrder(){
        $all_order = $this->order;
    // ->join('author_books', 'author_books.book_id', '=', 'store_orders.book_id') // もしstore_ordersの中にbook_idがあるなら
    // ->join('books', 'books.id', '=', 'author_books.book_id') // こちらを正しいテーブル名に
    // ->join('authors', 'author_books.author_id', '=', 'authors.id')
    // ->select('books.*', 'authors.name as author_name') // 必要なカラムを選択
    // ->get();

    // dd($bookinfo);
        return view('users.store.books.inventory')->with(compact('all_order'));
    }







    public function addBookTOInventory(StoreBooklistRequest $request){
        // dd($request);
        $validated = $request->validated();

        foreach($validated['book_id'] as $book_id){
            $inventory = new Inventory; //access to a model
            // private $inventory  $this->inventory
            $inventory->store_id = Auth::user()->id;
            $inventory->book_id = $book_id;
            $inventory->stock = 0;
            $inventory->save();
        }
        
        return redirect()->route('store.inventory');
    }



    public function addToNewconfirm(StoreInventoryRequest $request)
{
   
    $validated = $request->validated();
    Log::info('count');
    Log::info(count($validated['book_id']));
    foreach($validated['book_id'] as $index => $book_id) {
        $amount = $validated['amount'][$index]; // 対応するamountを取得

       Log::info('amount');
       Log::info($amount);

        if($amount > 0) {
            // 正のamountならレコードを保存または更新
            StoreOrder::create(
                [   'book_id' => $book_id, 
                    'user_id' => Auth::user()->id, // 条件に基づきレコードを探す
                    'quantity' => $amount,
                ] // amountを更新
            );

            // $this->order->book_id = $book_id;
            // $this->order->store_id =  Auth::user()->id;
            // $this->order->amount = $amount;
            // $this->order->save();
            // dd($request);

        } else {
            // amountが0の場合はレコードを削除
            Inventory::where('store_id', Auth::user()->id)
                      ->where('book_id', $book_id)
                      ->delete();
        }
    }

    return redirect()->route('store.newOrderConfirm'); // 新規発注確認画面へリダイレクト
}

    public function newOrderConfirm()
    {
        $user = Auth::user();
        return view('users.store.books.new-order-confirm', compact('user'));
    }



    











public function deleteInventory($book_id)
{
   
    Inventory::where('store_id', Auth::user()->id)
              ->where('book_id', $book_id)
              ->delete();

    // dd($book_id);
    
    return redirect()->route('store.inventory'); // 在庫画面にリダイレクト
}


// public function updateAndDelete(StoreInventoryRequest $request){

//     $validated = $request->validated();

//     if(strpos($request->action, 'delete')===0){
//         $parts = explode('-', $request->action);
//         $index = end($parts);
//         $this->order->destroy($validated['book_id'][$index]);
//         return redirect()->back();

//     }elseif($request->action === 'update'){
//         foreach($validated['book_id'] as $index =>$book_id){
//         if($validated['amount'][$index]>0){
//             $amount = $validated['amount'][$index];
//             $this->order->where('id',$book_id)->update(['amount'=>$amount]);
//         }else{
//             $this->order->destroy($validated['book_id'][$index]);
//         }
//     }
//     return redirect()->route('store.inventory');
//     }
// }



}
