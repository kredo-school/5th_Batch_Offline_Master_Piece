<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\GuestOrderRequest;

class GuestOrderController extends Controller
{

    private $book;
    private $reserve;
    private $user;
    public function __construct(Book $book, Reserve $reserve, User $user)
    {
        $this->book = $book;
        $this->reserve = $reserve;
        $this->user = $user;
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

    public function confirm()
    {
        $reserves = Auth::user()->reserves()->with('store')->get();

        $selected_stores = $this->selected_stores($reserves);
        $stores = $this->stores($selected_stores);

        $subtotal_amount = 0;
        $subtotal_price = 0;
        $total_price = 0;
        return view('users.guests.order.confirm')->with(compact('reserves', 'selected_stores', 'stores', 'subtotal_amount', 'subtotal_price', 'total_price'));
    }

    public function selected_stores($reserves)
    {
        $selected_stores = [];
        foreach($reserves as $reserve):
            $selected_stores[] = $reserve->store_id;
        endforeach;

        return $selected_stores;
    }

    public function stores($selected_stores)
    {
        $all_users = $this->user->all();

        $stores = [];
        foreach($all_users as $user):
            if(in_array($user->id, $selected_stores)){
                $stores[] = $user;
            }
        endforeach;

        return $stores;
    }

    public function reserve()
    {
        $reserves = Auth::user()->reserves()->with('store')->get();
        $selected_stores = $this->selected_stores($reserves);
        $stores = $this->stores($selected_stores);
        foreach($stores as $store):
            foreach ($reserves as $reserve){
                if ($store->id == $reserve->store_id){
                    $reserve->update(['reservation_number', $reserve->updated_at.$store->id]);
                }
            }
        endforeach;

        return view('users.guests.order.reserved');
    }

    public function reserved()
    {
        return view('users.guests.order.reserved');
    }

}
