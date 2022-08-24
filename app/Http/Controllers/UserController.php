<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * ログインユーザー情報を返す
     *
     * @param Request $request
     * @return JSON response
     */
    public function getLoginUserInfo(Request $request)
    {
        $user =  Auth::user();
        return response()->json([
            'name' => $user->name
        ], 200);
    }
}
