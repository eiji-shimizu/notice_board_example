<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WordsController extends Controller
{
    /**
     * 単語を返す
     *
     * @param Request $request
     * @param [string] $key
     * @return JSON response
     */
    public function get(Request $request, $key)
    {
        return response()->json([
            'code'     => 200,
            'contents' => __($key)
        ], 200);
    }
}
