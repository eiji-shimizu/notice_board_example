<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ItemController extends Controller
{
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function addItem(Request $request)
    {
        // 本来は入力チェックが必要
        // ただし不正値が来てもDB側のテーブル定義に反する場合はINSERTされることはない
        \DB::beginTransaction();
        try {
            $uuidStr = Str::remove('-', Str::uuid()->toString());
            Log::debug($uuidStr);
            \DB::table('items')->insert([
                'text' => $request->input('text'),
                'user_id' => Auth::user()->getAuthIdentifier(),
                'image_id' => $uuidStr,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            if (!is_null($request->file('file'))) {
                Log::debug($request->file('file')->getClientOriginalName());
            }
            // \DB::table('images')->insert([
            //     'image' => $request->file,
            //     'user_id' => Auth::user()->getAuthIdentifier(),
            //     'created_at' => Carbon::now(),
            //     'updated_at' => Carbon::now()
            // ]);
            \DB::commit();
        } catch (\Exception $e) {
            Log::debug($e);
            \DB::rollback();
        }
    }
}
