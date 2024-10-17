<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\GuestOrderRequest;

class GuestOrderController extends Controller
{

    private $book;
    private $reserve;
    public function __construct(Book $book, Reserve $reserve)
    {
        $this->book = $book;
        $this->reserve = $reserve;
    }

    public function show()
    {
        $reserves = Auth::user()->reserves()->get();

        return view('users.guests.order.show')->with(compact('reserves'));
    }

    public function updateAndDelete(GuestOrderRequest $request)
    {
        $validated = $request->validated();

        if(strpos($request->action,'delete') === 0){ //Delete Button
            $parts = explode('-', $request->action);
            $index = end($parts);
            $this->reserve->destroy($validated['reserve_id'][$index]);

            return redirect()->back();

        }elseif($request->action === 'update'){ //Update Button
            foreach($validated['reserve_id'] as $index => $reserve_id):

                if($validated['amount'][$index] > 0){
                    $amount = $validated['amount'][$index];
                    $this->reserve->where('id', $reserve_id)->update(['amount' => $amount]);
                }else{
                    $this->reserve->destroy($validated['reserve_id'][$index]);
                }
            endforeach;

            return redirect()->route('order.confirm');
        }
    }
}
