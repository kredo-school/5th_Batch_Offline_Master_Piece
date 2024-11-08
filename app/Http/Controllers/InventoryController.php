<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    private $inventory;

    public function __construct(Inventory $inventory)
    {
        $this->inventory = $inventory;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories=$this->inventory
        ->join('authors_books', 'authors_books.book_id', '=', 'store_orders.book_id') // もしstore_ordersの中にbook_idがあるなら
        ->join('books', 'books.id', '=', 'authors_books.book_id') // こちらを正しいテーブル名に
        ->join('authors', 'authors_books.author_id', '=', 'authors.id')
        ->select('books.*', 'authors.name as author_name') // 必要なカラムを選択
        ->get();

        // dd($inventories);
        return view('users.store.books.inventory')->with(compact('inventories'));
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
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
