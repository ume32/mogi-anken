<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle($item_id)
    {
        $user = Auth::user();
        $favorite = Favorite::where('user_id', $user->id)->where('item_id', $item_id)->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'item_id' => $item_id,
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
