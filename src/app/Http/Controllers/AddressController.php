<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * 住所変更画面の表示
     */
    public function edit($item_id)
    {
        $item = Item::findOrFail($item_id); // 修正: 正しい変数を使用
        $address = Address::where('user_id', Auth::id())->first();

        return view('purchase.address', compact('item', 'address'));
    }

    /**
     * 住所の更新処理
     */
    public function update(Request $request, $item_id)
    {
        $request->validate([
            'postal_code' => 'required|string|max:8',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255'
        ]);

        Address::updateOrCreate(
            ['user_id' => auth()->id()], // ユーザーの住所を更新または作成
            [
                'postal_code' => $request->postal_code,
                'address_line1' => $request->address_line1,
                'address_line2' => $request->address_line2,
            ]
        );

        return redirect()->route('items.show', $item_id)->with('success', '住所を更新しました！');
    }
}
