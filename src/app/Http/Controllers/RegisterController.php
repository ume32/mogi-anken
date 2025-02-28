<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // 会員登録後のリダイレクト先を変更
    protected function registered(Request $request, $user)
    {
        return redirect()->route('users.profile.edit');
    }
}

