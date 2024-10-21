<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
        $reserves = $this->reserve->where('guest_id', Auth::id())
                                    ->whereNull('reservation_number')
                                    ->get();

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
                    do {
                        // 店舗ごとに予約番号を生成
                        $reservationNumber = $store->id . '-' . date('Ymd') . '-' . Str::random(8);
                        // 予約番号がすでに使われているかを確認
                        $exists = $this->reserve->where('reservation_number', $reservationNumber)->exists();
                    } while ($exists);  // 重複があった場合、再度生成する
                }
            }

            $this->reserve->where('store_id', $store->id)->update(['reservation_number' => $reservationNumber]);
        endforeach;

        return view('users.guests.order.reserved');
    }

    public function reserved()
    {
        $reserves = Auth::user()->reserves()->with('store')->get();
        $selected_stores = $this->selected_stores($reserves);
        $stores = $this->stores($selected_stores);

        $reservationNumber = [];
        foreach($reserves as $reserve):
            if(!isset($reservationNumber[$reserve->store_id])){
                $reservationNumber[$reserve->store_id] =  $reserve->reservation_number;
            }
        endforeach;

        $today = Carbon::now()->format('m/d/Y');
        $threeDaysLater = Carbon::now()->addDays(3)->format('m/d/Y');

        $total_amount = 0;
        $total_price = 0;
        foreach($reserves as $reserve):
            $total_amount += $reserve->amount;
            $total_price = $reserve->amount * $reserve->book->price + $total_price;
        endforeach;

        return view('users.guests.order.reserved')->with(compact('stores', 'reserves', 'reservationNumber', 'today', 'threeDaysLater', 'total_amount', 'total_price'));
    }

}
