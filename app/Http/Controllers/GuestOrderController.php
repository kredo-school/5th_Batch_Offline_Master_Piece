<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Reserve;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Http\Requests\GuestOrderRequest;

class GuestOrderController extends Controller
{

    private $reserve;
    private $user;
    private $inventory;
    public function __construct(Reserve $reserve, User $user, Inventory $inventory)
    {
        $this->reserve = $reserve;
        $this->user = $user;
        $this->inventory = $inventory;
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

                if($validated['quantity'][$index] > 0){
                    $quantity = $validated['quantity'][$index];
                    $this->reserve->where('id', $reserve_id)->update(['quantity' => $quantity]);
                }else{
                    $this->reserve->destroy($validated['reserve_id'][$index]);
                }
            endforeach;

            return redirect()->route('order.confirm');
        }
    }

    public function confirm()
    {
        // $reserves = Auth::user()->reserves()->with('store')->get();
        $reserves = $this->reserve->where('guest_id', Auth::id())
                                    ->whereNull('reservation_number')
                                    ->get();

        $selected_stores = $this->selected_stores($reserves);
        $stores = $this->stores($selected_stores);

        $subtotal_quantity = 0;
        $subtotal_price = 0;
        $total_price = 0;
        return view('users.guests.order.confirm')->with(compact('reserves', 'selected_stores', 'stores', 'subtotal_quantity', 'subtotal_price', 'total_price'));
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
        DB::beginTransaction();

        try{
            $reserves = $this->reserve->where('guest_id', Auth::id())
                                    ->whereNull('reservation_number')
                                    ->get();
            $selected_stores = $this->selected_stores($reserves);
            $stores = $this->stores($selected_stores);

            // add reservation number
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

            // change store's inventory
            foreach($reserves as $reserve):
                if($reserve->quantity <= $reserve->inventory->stock){
                    $stock = $reserve->inventory->stock - $reserve->quantity;
                }else{
                    $stock = 0;
                }
                $this->inventory->where('id', $reserve->inventory->id)->update(['stock' => $stock]);
            endforeach;


            DB::commit();
            return redirect()->route('order.reserved');

        }catch(\Exception $e){
            DB::rollBack();

            Log::error('Transaction failed: ' .$e->getMessage());
        }
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

        $total_quantity = 0;
        $total_price = 0;
        foreach($reserves as $reserve):
            $total_quantity += $reserve->quantity;
            $total_price = $reserve->quantity * $reserve->book->price + $total_price;
        endforeach;

        return view('users.guests.order.reserved')->with(compact('stores', 'reserves', 'reservationNumber', 'today', 'threeDaysLater', 'total_quantity', 'total_price'));
    }

}
