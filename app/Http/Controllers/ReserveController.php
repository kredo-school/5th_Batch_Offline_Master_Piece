<?php

namespace App\Http\Controllers;

use App\Models\Reserve;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    private $reserve;
    public function __construct(Reserve $reserve)
    {
        $this->reserve = $reserve;
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
    public function show(Reserve $reserve)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserve $reserve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserve $reserve)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserve $reserve)
    {
        //
    }

    public function getBooksByReservationNumber(Request $request)
    {
        $reservationNumber = $request->input('reservation_number');

        // reservation_numberに一致するすべてのレコードを取得
        $reserves = Reserve::where('reservation_number', $reservationNumber)->with('book')->get();

        if ($reserves->isEmpty()) {
            return response()->json(['error' => 'No books found for the provided reservation number.'], 404);
        }

        // 必要な情報のみ抽出して返す
        $bookData = $reserves->map(function ($reserve) {
            return [
                'book_id' => $reserve->book->id,
                'title' => $reserve->book->title,
                'price' => $reserve->book->price,
                'quantity' => $reserve->quantity,
            ];
        });

        return response()->json($bookData);
    }
}
