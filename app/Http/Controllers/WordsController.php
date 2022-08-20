<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class WordsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
