<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\Address;

use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function show($item_id)
    {
        $item = Item::findOrFail($item_id);
        $address = Address::where('user_id', Auth::id())->first();
        return view('purchase.confirm', compact('item', 'address'));
    }

    public function store(Request $request, $item_id)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|in:credit,convenience',
        ]);

        $purchase = new Purchase();
        $purchase->user_id = Auth::id();
        $purchase->item_id = $item_id;
        $purchase->address = $request->address;
        $purchase->payment_method = $request->payment_method;
        $purchase->save();

        return redirect()->route('mypage')->with('success', '購入が完了しました！');
    }

    public function confirm($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = Auth::user();
        $address = Address::where('user_id', $user->id)->first();

        return view('purchase.confirm', compact('item', 'user', 'address'));
    }
}
