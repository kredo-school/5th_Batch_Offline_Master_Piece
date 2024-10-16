<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreOrder;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventory;

class OrderController extends Controller
{
    private $order;

    public function __construct(StoreOrder $storeOrder)
    {
        $this->order = $storeOrder;
    }

    public function storeNewConfirmShow(){
        $bookinfo = $this->order
    ->join('author_books', 'author_books.book_id', '=', 'store_orders.book_id') // もしstore_ordersの中にbook_idがあるなら
    ->join('books', 'books.id', '=', 'author_books.book_id') // こちらを正しいテーブル名に
    ->join('authors', 'author_books.author_id', '=', 'authors.id')
    ->select('books.*', 'authors.name as author_name') // 必要なカラムを選択
    ->get();

    // dd($bookinfo);
        return view('users.store.books.new-order-confirm')->with(compact('bookinfo'));
    }


    public function addBookTOInventory(StoreOrderRequest $request){
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

    
}
