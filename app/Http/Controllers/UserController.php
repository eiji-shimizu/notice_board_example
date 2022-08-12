<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 新規ユーザー登録
     *
     * @return \Illuminate\View\View
     */
    public function register()
    {
        // 1.既に登録済みのユーザー名であった場合 -> 登録不可
        // 2.登録済みのメールアドレスであった場合 -> 登録不可
        // 3.それ以外 -> 登録処理
        // 送られてきたメールアドレスにトークンの値を含んだメール送信
        // そのメールアドレスにて確認処理がなされた場合ユーザー登録とする
        return view('welcome');
    }

    /**
     * ログイン
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        // 1.既に登録済みのユーザー名とパスワードが一致した場合 -> ログイン処理
        // 2.既に登録済みのメールアドレスとパスワードが一致した場合 -> ログイン処理
        // メールアドレスにトークンの値を含んだメール送信
        // そのメールアドレスにて確認処理がなされた場合ログイン可とする
        
        // 本当は2段階認証の種類を選べるようにして,同じメールアドレスでは確認しない方がよい
        // また省略のための機能もあった方がよい
        // しかしいずれも今のところは実装対象外とする
        return view('welcome');
    }
}
