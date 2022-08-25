<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            $uuidStr = null;
            if (!is_null($request->file('file'))) {
                // 画像ファイルがアップロードされてきた場合はファイル名を生成
                $uuidStr = Str::remove('-', Str::uuid()->toString());
            }
            Log::debug($uuidStr);
            \DB::table('items')->insert([
                'text' => $request->input('text'),
                'user_id' => Auth::user()->getAuthIdentifier(),
                'image_id' => $uuidStr,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            if (!is_null($request->file('file'))) {
                // 拡張子をつけたファイル名にして保存する
                $file = $request->file('file');
                Log::debug($file->getClientOriginalName());
                $extension = $file->getClientOriginalExtension();
                $fileName = $uuidStr . '.' . $extension;
                Log::debug($fileName);
                $file->storeAs('', $fileName);
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            throw new \Exception("unexpected error has occurred.", 0, $e);
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param [type] $key
     * @return void
     */
    public function getImage(Request $request, $key)
    {
        return Storage::download($key);
    }
}
