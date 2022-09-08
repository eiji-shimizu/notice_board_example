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
     * 投稿データを保存する
     * 戻り値は本来は結果のJSONであるべきであるがここではvoidとする
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
                // ファイルサイズ確認
                // laravelの入力チェック機構を調べ切れていないためここでは普通にif文でチェックする
                // 1000 * 1000 = 1000000byte(1Mbyte)より大きければエラー
                $limit = 1000 * 1000;
                Log::debug('--------------------------------------------');
                if ($request->file('file')->getSize() > $limit) {
                    Log::debug('upload file size: ' . $request->file('file')->getSize() . ' bytes is over limit.');
                    return;
                }
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
     * 投稿データのリストを返す
     *
     * @param Request $request
     * @return JSON response
     */
    public function getItems(Request $request)
    {
        $users = \DB::table('users')->select('id as user_id', 'name');
        $result = \DB::table('items')->leftJoinSub($users, 'users', function ($join) {
            $join->on('items.user_id', '=', 'users.user_id');
        })->get();
        return response()->json([
            'items' => $result
        ], 200);
    }

    /**
     * $keyで指定された画像データをダウンロードする
     *
     * @param Request $request
     * @param [string] $key
     * @return JSON response
     */
    public function getImage(Request $request, $key)
    {
        return Storage::download($key);
    }

    /**
     * 投稿データを削除する
     * 戻り値は本来は結果のJSONであるべきであるがここではvoidとする
     *
     * @param Request $request
     * @return void
     */
    public function removeItem(Request $request)
    {
        \DB::beginTransaction();
        try {
            // 削除対象レコードを取得
            $target = \DB::table('items')
                ->whereRaw('id = ? AND user_id = ?', [$request->input('id'), Auth::user()->id])
                ->get();
            Log::debug($target);
            if (count($target) === 1) {
                // レコードを削除する
                \DB::table('items')->whereRaw('id = ? AND user_id = ?', [$request->input('id'), Auth::user()->id])->delete();
                // 投稿画像ファイルを削除する
                if (!is_null($target[0]->image_id)) {
                    $key = $target[0]->image_id . '.png';
                    Storage::delete($key);
                }
            }
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
            throw new \Exception("unexpected error has occurred.", 0, $e);
        }
    }
}
