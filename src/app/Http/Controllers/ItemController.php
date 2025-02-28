<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Address;

class ItemController extends Controller
{
    // 商品一覧ページ
    public function index(Request $request)
    {
        // 検索キーワードの取得
        $search = $request->input('search');

        // クエリビルダーで検索
        $query = Item::query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $items = $query->get();

        // マイリスト（ログインユーザーが「いいね」した商品）
        $myItems = Auth::check() ? Auth::user()->likedItems()->get() : collect([]);

        return view('items.index', compact('items', 'myItems', 'search'));
    }

    // 商品出品ページ
    public function create()
    {
        return view('items.create');
    }

    // 商品を保存（出品処理）
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        $item = new Item();
        $item->name = $request->name;
        $item->category = $request->category;
        $item->description = $request->description;
        $item->price = $request->price;

        // 画像がアップロードされた場合の処理
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('items', 'public');
            $item->image = $path;
        }

        $item->save();

        return redirect()->route('items.index')->with('success', '商品を出品しました！');
    }

    // 商品詳細ページ
    public function show($id)
    {
        $item = Item::with(['comments.user'])->findOrFail($id);
        $address = Auth::check() ? Address::where('user_id', Auth::id())->first() : null;

        return view('items.show', compact('item', 'address'));
    }
}
