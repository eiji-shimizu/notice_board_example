<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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
        Log::debug('addItem');
        Log::debug($request->input('text'));
        Log::debug($request->file->getClientOriginalName());
    }
}
