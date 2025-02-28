<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Item;
use App\Models\Purchase;

class UserController extends Controller
{
    /**
     * 初回プロフィール設定画面を表示
     */
    public function editProfile()
    {
        $user = Auth::user();  // 現在ログイン中のユーザー情報を取得
        return view('users.edit', compact('user'));  // users/edit.blade.php にデータを渡す
    }

    /**
     * 初回プロフィール情報を保存（username を削除）
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'postcode' => 'required|string|max:8',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'postcode.required' => '郵便番号は必須です。',
            'address.required' => '住所は必須です。',
            'phone.required' => '電話番号は必須です。',
            'profile_image.image' => 'アップロードされたファイルは画像である必要があります。',
            'profile_image.max' => '画像のサイズは2MB以下にしてください。',
        ]);

        $user = Auth::user();
        $user->postcode = $request->postcode;
        $user->address = $request->address;
        $user->phone = $request->phone;

        // プロフィール画像の処理
        if ($request->hasFile('profile_image')) {
            // 既存の画像を削除
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            // 新しい画像を保存
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return redirect()->route('items.index')->with('success', 'プロフィールが更新されました。');
    }

    /**
     * ユーザープロフィールを表示
     */
    public function showProfile()
    {
        $user = Auth::user();
        $purchasedItems = Purchase::where('user_id', $user->id)->get();
        $soldItems = Item::where('user_id', $user->id)->get();

        return view('users.profile', compact('user', 'purchasedItems', 'soldItems'));
    }
}
